<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\Admin;
use App\Models\PropertyOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $request->merge(["guard" => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin,owner,employee'
        ]);
        if (!$validator->fails()) {
            return response()->view('dashboard.auth.login', ['guard' => $request->input('guard')]);
        } else {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    //login
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => "required|email",
            'password' => 'required',
            'guard' => 'required|string|in:admin,owner',
        ]);

        if (!$validator->fails()) {

            $crendentials = ['email' => $request->input('email'), 'password' => $request->input('password'), 'verified' => true];

            if (Auth::guard($request->input('guard'))->attempt($crendentials)) {

                return response()->json(['message' => 'Logged in successfully'], Response::HTTP_OK);
            } else {
                return response()->json(
                    ['message' => 'Login failed, check your credentials'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    public function showRegister(Request $request)
    {
        return view('dashboard.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => "required|string|max:100",
            'email' => "required|email",
            'phone' => "required|numeric",
            'password' => 'required',
        ]);

        if (!$validator->fails()) {
            $code = random_int(100000, 999999);
            $propertyOwner = new PropertyOwner();
            $propertyOwner->name = $request->input('name');
            $propertyOwner->email = $request->input('email');
            $propertyOwner->phone = $request->input('phone');
            $propertyOwner->password = Hash::make($request->input('password'));
            $propertyOwner->verification_code = Hash::make($code);
            $isSaved = $propertyOwner->save();
            if ($isSaved) {
                Mail::to($propertyOwner)->queue(new VerifyEmail($propertyOwner, $code));
                return redirect()->route('verify.account', $propertyOwner->id);
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }
    public function showVerificationCode($id)
    {
        return view('dashboard.auth.verification-code', ['owner_id' => $id]);
    }

    public function verificationCode(Request $request, $id)
    {
        $verification = implode('', $request->verify);
        $owner = PropertyOwner::where('id', $id)->first();
        if (!is_null($owner->verification_code)) {

            if (Hash::check($verification, $owner->verification_code)) {
                $owner->verification_code = null;
                $owner->verified = true;
                $isSaved = $owner->save();
                return response()->json([
                    'status' => $isSaved,
                    'message' => $isSaved ? 'Property Owner Added successfully' : 'Failed to Add Property Owner',
                ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    'message' => 'validation not true',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' =>  'Failed Add Property Owner',
            ],  Response::HTTP_BAD_REQUEST);
        }
    }

    // logout
    public function logout(Request $request)
    {
        $guard = auth('owner')->check() ? 'owner' : 'admin';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('dashboard.login', $guard);
    }

    public function showForgetPassword(Request $request)
    {
        return response()->view('dashboard.auth.forget-password');
    }

    public function emailForgetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email',
        ]);
        if (!$validator->fails()) {
            $status = Password::sendResetLink($request->only('email'));
            return $status === Password::RESET_LINK_SENT
                ? response()->json(['message' => __($status)], Response::HTTP_OK)
                : response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(Request $request, $token)
    {
        return response()->view(
            'dashboard.auth.recover-password',
            [
                'token' => $token,
                'email' => $request->input('email')
            ]
        );
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'token' => 'required',
            'email' => 'required | email',
            'password' => 'required | confirmed',
            // 'guard' => 'required|in:admin,store'
        ]);

        if (!$validator->fails()) {
            // $broker = $request->get('guard') == 'admin' ? 'admins' : 'stores';

            $status = Password::reset(
                $request->all(),
                function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                ? response()->json(['message' => __($status)], Response::HTTP_OK)
                : response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
}

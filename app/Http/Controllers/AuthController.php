<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\Admin;
use App\Models\PropertyOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
                // return
                //     view('dashboard.auth.verification-code', ['owner_id' => $propertyOwner->id]);
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
        // dd($id);
        return view('dashboard.auth.verification-code', ['owner_id' => $id]);
    }

    public function verificationCode(Request $request, $id)
    {
        // $validator = Validator($request->all(), [
        //     'data' => "required",
        // ]);

        // if (!$validator->fails()) {

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
        // } else {
        //     return response()->json(
        //         ['message' => $validator->getMessageBag()->first()],
        //         Response::HTTP_BAD_REQUEST,
        //     );
        // }
    }

    // logout
    public function logout(Request $request)
    {
        $guard = auth('owner')->check() ? 'owner' : 'admin';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('dashboard.login', $guard);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PropertyOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'guard' => 'required|string|in:admin,owner,employee',
        ]);

        if (!$validator->fails()) {
            $crendentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
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
        // $request->merge(["guard" => $request->guard]);
        // $validator = Validator($request->all(), [
        //     'guard' => 'required|string|in:admin,owner,employee'
        // ]);
        // if (!$validator->fails()) {
        //     return response()->view('dashboard.auth.login', ['guard' => $request->input('guard')]);
        // } else {
        //     abort(Response::HTTP_NOT_FOUND);
        // }
    }

    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => "required|string|max:100",
            'email' => "required|email",
            'phone' => "required|numeric",
            'password' => 'required',
            // 'guard' => 'required|string|in:admin,owner,employee',
        ]);

        if (!$validator->fails()) {
            $propertyOwner = new PropertyOwner();
            $propertyOwner->name = $request->input('name');
            $propertyOwner->email = $request->input('email');
            $propertyOwner->phone = $request->input('phone');
            $propertyOwner->password = Hash::make($request->input('password'));
            $isSaved = $propertyOwner->save();
            return response()->json(
                ['message' => $isSaved ? 'Property Owner Added successfully' : 'Failed to Add Property Owner'],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
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
}

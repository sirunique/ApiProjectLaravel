<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->login($request);
    }

    public function login(Request $request){
        $input = $request->only('email', 'password');
        $jwt_token = null;
        if(!$jwt_token = JWTAuth::attempt($input)){
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request){
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully',
            ]);
        } catch (JWTException $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry user cannot be loggrd out',
            ], 500);
        }
    }

    public function getCurrentUser(Request $request){
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);
        return $user;
    }

    // public function update(Request $request){
        
    // }
}

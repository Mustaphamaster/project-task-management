<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
    /**
    * Register user.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function register(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'name'     => 'required|string|min:2|max:100',
           'email'    => 'required|string|email|max:100|unique:users',
           'password' => 'required|string|min:6',
       ]);

       if($validator->fails()) {
           return response()->json($validator->errors(), 400);
       }

       $user = User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password)
           ]);

       return response()->json([
            'success' => true,
            'message' => 'User successfully registered',
            'user' => $user
       ], 201);
   }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            "password" => "required|min:6",
        ]);

        if ($validator->fails())
            return response()->json([
                'success' => false,
                "message" => $validator->errors()
            ], 409);

        $inputs = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($inputs)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token'   => $token,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        try {
            Auth::logout();

            return response()->json([
                'success' => true,
                'message' => "User logged out successfully"
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => "Sorry, the user cannot be logged out"
            ], 500);
        }
    }

    /**
     * Refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = Auth::refresh();

        return response()->json([
            'success' => true,
            'token'   => $token,
        ]);
    }

}

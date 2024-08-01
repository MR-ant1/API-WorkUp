<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');

            $validator = Validator::make($request->all(), [
                "email" => "required",
                "password" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => "Login failed",
                    "error" => $validator->errors()
                ]);
            }
            $user = User::query()->where('email', $email)->first();

            // if (!$user) {
            //     return response()->json(
            //         [
            //             'success' => false,
            //             'message' => "Couldnt login",
            //         ],
            //         400
            //     );
            // }
            $checkPasswordUser = Hash::check($password, $user->password);

            if (!$checkPasswordUser) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or password not valid",
                        // "error" => $th->getMessage()
                    ],
                    400
                );
            }

            // Crear token
            $token = $user->createToken('back-token')->plainTextToken;

            // Responder con el token
            return response()->json(
                [
                    "success" => true,
                    "message" => "user logged succesfully",
                    "token" => $token
                ],
                200
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "User cant be logged",
                    // 'error' => $th->getMessage() 
                ],
                500
            );
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(
            [
                'success' => true,
                'message' => "User logged out successfully"
            ],
            200
        );
    }

    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role = "user"; 
            $user->password = bcrypt($request->input('password'));

            $validator = Validator::make($request->all(), [
                "name" => "required|String",
                "email" => "required|unique:users",
                "password" => "required|min:4|max:15"
            ]);
            Log::info(1);
            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "message" => "Validation failed",
                    "error" => $validator->errors()
                ]);
            };
            Log::info(2);
            $user->save();
            Log::info(3);
            return response()->json(
                [
                    'success' => true,
                    'message' => "User registered succesfully",
                    'data' => $user
                ],
                201
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "User cant be registered",
                ],
                500
            );
        }
    }
}


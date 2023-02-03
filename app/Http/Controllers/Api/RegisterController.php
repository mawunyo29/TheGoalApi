<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *    path="/api/v1/register",
     *   tags={"Auth"},
     *  summary="Register",
     * description="Returns user data",
     * operationId="Register",
     * @OA\RequestBody(
     *   required=true,
     *  description="Pass user data",
     * @OA\JsonContent(
     * required={"name","email","password","password_confirmation"},
     * @OA\Property(property="name", type="string", format="name", example="mawunyo"),
     * @OA\Property(property="email", type="string", format="email", example="amdin@admin.fr"),
     * @OA\Property(property="password", type="string", format="password", example="password"),
     * @OA\Property(property="password_confirmation", type="string", format="password", example="password"),
     * ),
     * ),
     * @OA\Response(
     *  response=200,
     * description="successful operation",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="User register successfully"),
     * ),
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid input",
     * ),
     * @OA\Response(
     * response=404,
     * description="Resource Not Found",
     * ),
     * )
     * @param Request $request
     */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken('authToken')->accessToken;
        return response()->json([
            'message' => 'Successfully created user!',
            'token' => $token
        ], 201);
    }

}

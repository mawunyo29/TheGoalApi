<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginApiPostRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class AuthApiController extends Controller
{

    /**
     * @OA\Post(
     *    path="/api/v1/login",
     *   tags={"Auth"},
     *  summary="Login",
     * description="Returns user data",
     * operationId="Login",
     * @OA\RequestBody(
     *   required=true,
     *  description="Pass user data",
     * @OA\JsonContent(
     * required={"email","password"},
     * @OA\Property(property="email", type="string", format="email", example="mawunyo73@contact.fr"),
     * @OA\Property(property="password", type="string", format="password", example="password"),
     * ),
     * ),
     * @OA\Response(
     *   response=200,
     *  description="successful operation",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="User login successfully"),
     * ),
     * ),
     * @OA\Response(
     *  response=400,
     * description="Invalid input",
     * ),
     * @OA\Response(
     * response=404,
     * description="Resource Not Found",
     * ),
     * )
     * @param LoginApiPostRequest $request
     */

    public function login(LoginApiPostRequest $request)
    {
        info(request());
        $request->authenticate();
        if(!Auth::check()) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
        $user = $request->user();
        $token = $user->createToken('token')->plainTextToken;
        $request->session()->regenerateToken();
        info($user->tokenks);
        return response()->json([
            'message' => 'User login successfully',
            'token' => $token
        ]);
    }

    /**
     * @OA\Post(
     *    path="/api/v1/logout",
     *    tags={"Auth"},
     *    summary="Logout",
     *   description="Returns user data",
     *  operationId="Logout",
     * security={{"bearerAuth": {}}},
     * @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="User logout successfully"),
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
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden",
     * ),
     * @OA\Response(
     * response=500,
     * description="Internal Server Error",
     * ),
     * @OA\Response(
     * response=503,
     * description="Service Unavailable",
     * ),
     * @OA\Response(
     * response=429,
     * description="Too Many Requests",
     * ),
     * @OA\Response(
     * response=422,
     * description="Unprocessable Entity",
     * ),
     * @OA\Response(
     * response=405,
     * description="Method Not Allowed",
     * ),
     * @OA\Response(
     * response=409,
     * description="Conflict",
     * ),
     * @OA\Response(
     * response=406,
     * description="Not Acceptable",
     * ),
     * @OA\Response(
     * response=415,
     * description="Unsupported Media Type",
     * ),
     * 
     * )
     * @param Request $request
     */

    public function logout(Request $request)
    {
        if(Auth::guard('api')->check()){
            $request->user()->tokens()->delete();
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json([
                'message' => 'User logout successfully'
            ], 200);
        }else{
            return response()->json([
                'message' => 'User not authenticated'
            ], 401);
        }
      
    }
}

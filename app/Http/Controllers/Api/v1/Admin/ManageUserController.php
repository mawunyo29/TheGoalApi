<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageUserController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/v1/users",
     *      operationId="index", 
     *      tags={"Models Users"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     *      summary="Get list of users",
     *      description="Returns list of users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="id",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="John Doe"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="jhon@doe.com"
     *              ),
     *              
     *          )
     *       ), 
     *       @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *       ),
     *       @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found",
     *       ),
     * )
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user = Auth::check()   ;
        if ($user  && $request->bearerToken() ) {
            $users = User::all();
            return response()->json(['message'=>"You are login an can view users list" ,$users], 200);
        } else {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    }


    /**
     * @OA\Post(
     *    path="/api/v1/users",
     *   tags={"Models Users"},
     *  summary="Store new user",
     * description="Returns user data",
     * operationId="storeUser",
     * @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     * @OA\RequestBody(
     *   required=true,
     *  description="Pass user data",
     * @OA\JsonContent(
     * required={"name","email","password"},
     * @OA\Property(property="name", type="string", format="text", example="John"),
     * @OA\Property(property="email", type="string", format="email", example="mawunyo73@contact.fr"),
     * @OA\Property(property="password", type="string", format="password", example="password"),
     * ),
     * ),
     * @OA\Response(
     *   response=200,
     *  description="successful operation",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="User created successfully"),
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
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * )
     * security={{"bearerAuth":{}}}
     */

    public function store(Request $request)
    {
        //check if the user is authenticated

        if ($request->bearerToken()) {
            $authUser = Auth::check();

            if ($authUser) {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
                if ($request->hasFile('avatar')) {
                    $request->validate([
                        'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);
                    $avatarName = time() . '.' . $request->avatar->extension();
                    $request->avatar->move(public_path('images'), $avatarName);
                    $request->merge(['avatar' => $avatarName]);
                }
                $request->merge(['password' => bcrypt($request->password)]);

                $user = User::create($request->all());
              $token =  $user->createToken('authToken',['categorie:store'])->plainTextToken;

                return response()->json(['message' => 'User created successfully', 'user' => $user ,'auth'=>$authUser ,'token'=> $token] , 200);
            }
            
        } else {
            return response()->json(['message' => 'You are not authorized to create a user'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *    path="/api/v1/users/{id}",
     *  tags={"Models Users"},
     * summary="Get user information",
     * description="Returns user data",
     * operationId="showUser",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * description="ID of user to return",
     * required=true,
     * @OA\Schema(
     * type="integer",
     * format="int64"
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(
     * @OA\Property(property="id", type="integer", format="int64", example="1"),
     * @OA\Property(property="name", type="string", format="text", example="John"),
     * @OA\Property(property="email", type="string", format="email", example="jhon@contact.fr"),
     * ),
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid ID supplied",
     * ),
     * @OA\Response(
     * response=404,
     * description="User not found",
     * ),
     * )
     * security={{"bearerAuth": {}} }
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Put(
     *   path="/api/v1/users/{id}",
     * tags={"Models Users"},
     * summary="Update an existing user",
     * description="Returns updated user data",
     * operationId="updateUser",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * description="ID of user to return",
     * required=true,
     * @OA\Schema(
     * type="integer",
     * format="int64"
     * )
     * ),
     * @OA\RequestBody(
     *  required=true,
     * description="Pass user data",
     * @OA\JsonContent(
     * required={"name","email","password"},
     * @OA\Property(property="name", type="string", format="text", example="John"),
     * @OA\Property(property="email", type="string", format="email", example="jhon@contact.fr"),
     * @OA\Property(property="password", type="string", format="password", example="password"),
     * ),
     * ),
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="User updated successfully"),
     * ),
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid ID supplied",
     * ),
     * @OA\Response(
     * response=404,
     * description="User not found",
     * ),
     * @OA\Response(
     * response=405,
     * description="Validation exception",
     * ),
     * security={{"bearerAuth": {}} },
     * )
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);

        if ($user) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($request->hasFile('avatar')) {
                $request->validate([
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                $avatarName = time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('images'), $avatarName);
                $request->merge(['avatar' => $avatarName]);
            }
            $request->merge(['password' => bcrypt($request->password)]);
            $user->update($request->all());
            return response()->json(['message' => 'User updated successfully'], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *  path="/api/v1/users/{id}",
     * tags={"Models Users"},
     * summary="Delete existing user",
     * description="Deletes a record and returns no content",
     * operationId="deleteUser",
     * @OA\Parameter(
     * name="id",
     * in="path",
     * description="ID of user to return",
     * required=true,
     * @OA\Schema(
     * type="integer",
     * format="int64"
     * )
     * ),
     * @OA\Response(
     * response=204,
     * description="successful operation",
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid ID supplied",
     * ),
     * @OA\Response(
     * response=404,
     * description="User not found",
     * ),
     * security={{"bearerAuth": {}} }
     * )
     */

    public function destroy($id)
    {
        //
        User::find($id)->delete();
    }
}

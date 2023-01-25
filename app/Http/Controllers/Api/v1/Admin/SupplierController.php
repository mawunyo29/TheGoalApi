<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
     /**
     * @OA\Get(
     *    path="/api/v1/suppliers",
     *   operationId="getSuppliersList",
     *  tags={"Models Suppliers"},
     * security={{"bearerAuth":{}}},
     * description="Returns list of suppliers",
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(
     * type="array",
     * @OA\Items(ref="#/components/schemas/Supplier"),
     * ),
     * ),
     * @OA\Response(
     *  response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden",
     * ),
     * @OA\Response(
     * response=404,
     * description="Not found",
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
     * response=504,
     * description="Gateway Timeout",
     * ),
     * @OA\Response(
     * response=422,
     * description="Unprocessable Entity",
     * ),
     * @OA\Response(
     * response=429,
     * description="Too Many Requests",
     * ),
     * @OA\Response(
     * response=405,
     * description="Method Not Allowed",
     * ),
     * @OA\Response(
     * response=400,
     * description="Bad Request",
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
     * @OA\Response(
     * response=501,
     * description="Not Implemented",
     * ),
     * @OA\Response(
     * response=502,
     * description="Bad Gateway",
     * ),
     * @OA\Response(
     * response=505,
     * description="HTTP Version Not Supported",
     * ),
     * @OA\Response(
     * response=507,
     * description="Insufficient Storage",
     * ),
     * @OA\Response(
     * response=511,
     * description="Network Authentication Required",
     * ),
     * @OA\Response(
     * response=520,
     * description="Unknown Error",
     * ),
     * @OA\Response(
     * response=521,
     * description="Web Server Is Down",
     * ),
     * @OA\Response(
     * response=522,
     * description="Connection Timed Out",
     * ),
     * @OA\Response(
     * response=523,
     * description="Origin Is Unreachable",
     * ),
     * @OA\Response(
     * response=524,
     * description="A Timeout Occurred",
     * ),
     * @OA\Response(
     * response=525,
     * description="SSL Handshake Failed",
     * ),
     * )
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if(!Auth::check()){
            return response()->json(['message'=>'unauthenticated'], 401);
         }else{
            $suppliers = Supplier::all();
            if($suppliers->isEmpty())
            {
                return response()->json(['message'=>'No suppliers found'], 404);
            }
            return response()->json($suppliers, 200);
         }
        
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     * path="/api/v1/suppliers",
     * summary="Store new supplier",
     * description="Returns supplier data",
     * operationId="storeSupplier",
     * tags={"Models Suppliers"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *   required=true,
     *  description="Pass supplier data",
     * @OA\JsonContent(
     *type="array",
     *@OA\Items(ref="#/components/schemas/StoreSupplierRequest"),
        * ),
        * ),
        * @OA\Response(
        * response=200,
        * description="successful operation",
        * @OA\JsonContent(
        * type="array",
        * @OA\Items(ref="#/components/schemas/Supplier"),
        * ),
        * ),
        * @OA\Response(
        *  response=401,
        * description="Unauthenticated",
        * ),
        * @OA\Response(
        * response=403,
        * description="Forbidden",
        * ),
        * @OA\Response(
        * response=404,
        * description="Not found",
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
        * response=504,
        * description="Gateway Timeout",
        * ),
        * @OA\Response(
        * response=422,
        * description="Unprocessable Entity",
        * ),
        * @OA\Response(
        * response=429,
        * description="Too Many Requests",
        * ),
        * @OA\Response(
        * response=405,
        * description="Method Not Allowed",
        * ),
        * @OA\Response(
        * response=400,
        * description="Bad Request",
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
        * @OA\Response(
        * response=501,
        * description="Not Implemented",
        * ),
        * @OA\Response(
        * response=502,
        * description="Bad Gateway",
        * ),
        * @OA\Response(
        * response=505,
        * description="HTTP Version Not Supported",
        * ),
        * @OA\Response(
        * response=507,
        * description="Insufficient Storage",
        * ),
        * @OA\Response(
        * response=511,
        * description="Network Authentication Required",
        * ),
        * @OA\Response(
        * response=520,
        * description="Unknown Error",
        * ),
        * @OA\Response(
        * response=521,
        * description="Web Server Is Down",
        * ),
        * @OA\Response(
        * response=522,
        * description="Connection Timed Out",
        * ),
        * @OA\Response(
        * response=523,
        * description="Origin Is Unreachable",
        * ),
        * @OA\Response(
        * response=524,
        * description="A Timeout Occurred",
        * ),
        * @OA\Response(
        * response=525,
        * description="SSL Handshake Failed",
        * ),
        * )
        * @return \Illuminate\Http\Response
        */
    public function store(StoreSupplierRequest $request)
    {
        if(!Auth::check()){
            return response()->json(['message'=>'unauthenticated'], 401);
         }else{
            
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->save();
            return response()->json($supplier, 201);
         }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

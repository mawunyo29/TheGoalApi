<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *    path="/api/v1/products",
     *   operationId="getProductsList",
     *  tags={"Models Products"},
     * security={{"bearerAuth":{}}},
     * summary="Get list of Products",
     * description="Returns list of Products",
     * parameters={
     *    @OA\Parameter(
     *       name="page",
     *     in="query",
     *  description="Page number",
     * required=false,
     * @OA\Schema(
     * type="integer",
     * format="int32",
     * ),
     * ),
     * @OA\Parameter(
     * name="limit",
     * in="query",
     * description="Limit number",
     * required=false,
     * @OA\Schema(
     * type="integer",
     * format="int32",
     * ),
     * ),
     * },
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(
     * type="array",
     * @OA\Items(ref="#/components/schemas/Product"),
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
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (Auth::check()) {
            $products = Product::paginate(10);
            if ($products->isEmpty()) {
                return response()->json(['message' => 'No products found'], 404);
            }
            return response()->json($products, 200);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/v1/products",
     *      operationId="productStore", 
     *      tags={"Models Products"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     *      summary="Store new product",
     *      description="Returns product data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreProductRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product"),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Invalid input",
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
     * @param  App\Http\Requests\StoreProductRequest  $request
     *    @return \Illuminate\Http\Response
     */

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name'], '-');
        $product = Product::create($data);
        return response()->json($product);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/products/{id}",
     *      operationId="productShow", 
     *      tags={"Models Products"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     *      summary="Get product information",
     *      description="Returns product data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product"),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Invalid input",
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
     * @param  int  $id
     *    @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $product = Product::find($id);
        if (Auth::check()) {


            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }
            return response()->json($product, 200);
        } else {
            return response()->json(['message' => 'You are not logged in'], 401);
        }
    }

    /**
     * @OA\Put(
     *      path="/api/v1/products/{id}",
     *      operationId="productUpdate", 
     *      tags={"Models Products"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     *      summary="Update existing product",
     *      description="Returns updated product data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product"),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Invalid input",
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
     */

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/products/{id}",
     *      operationId="productDestroy", 
     *      tags={"Models Products"},
     *      security={{" bearerAuth":{}}},
     *      @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     *      summary="Delete existing product",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Invalid input",
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
     */


    public function destroy($id)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/api/v1/products/name/{name}",
     *      operationId="productGetByName", 
     *      tags={"Models Products"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     *      summary="Get product by name",
     *      description="Returns product data",
     *      @OA\Parameter(
     *          name="name",
     *          description="Product name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Product"),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Invalid input",
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
     */

    public function getProductByname($name)
    {
        $product = Product::where('name', $name)->first();
        return response()->json($product);
    }



    public function getProductByPrice($price)
    {
        $product = Product::where('price', $price)->first();
        return response()->json($product);
    }

    public function getProductByDescription($description)
    {
        $product = Product::where('description', $description)->first();
        return response()->json($product);
    }


    public function getProductByPriceRange($min, $max)
    {
        $product = Product::whereBetween('price', [$min, $max])->get();
        return response()->json($product);
    }


    public function getProductByCategoryAndPriceRange($category, $min, $max)
    {
        $product = Product::where('category', $category)->whereBetween('price', [$min, $max])->get();
        return response()->json($product);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public $user;
    /**
     * security={{"bearerAuth":{}}}
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth:sanctum');
        $this->user = Auth::check();
        info($request . ' is logged in');
    }

    /**
     * @OA\Get(
     *    path="/api/v1/categories",
     *   operationId="getCategoriesList",
     *  tags={"Models Categories"},
     * summary="Get list of categories",
     * description="Returns list of categories",
     *   @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     * parameters={
     *     @OA\Parameter(
     *        name="page",
     *       in="query",
     *     description="Page number",
     *    required=false,
     *  @OA\Schema(
     *    type="integer",
     * format="int32",
     * ),
     * ),
     * @OA\Parameter(
     *   name="limit",
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
     * @OA\Items(ref="#/components/schemas/Category"),
     * ),
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid input",
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=404,
     * description="Resource Not Found",
     * ),
     * @OA\Response(
     * response=409,
     * description="Conflict",
     * ),
     * @OA\Response(
     * response=422,
     * description="Unprocessable Entity",
     * ),
     * @OA\Response(
     * response=500,
     * description="Internal Server Error",
     * ),
     * security={{"bearerAuth": {}}},
     * )
     * 
     */
    public function index()
    {
        //sactum error code 401
        //check is user is logged in guard
        Debugbar::info('test');
        $guarduser = Auth::guard('sanctum')->user();
        info($guarduser . ' not logged in');
       if(!$this->user){
        
       
           return response()->json(['error' => 'Unauthenticated'], 401);
       }
        $categories = Category::all();
        return response()->json(CategoryResource::collection($categories)) ;
    }

    /**
     * @OA\Post(
     *   path="/api/v1/categories",
     *  operationId="storeCategory",
     * tags={"Models Categories"},
     * summary="Store new category",
     * description="Returns category data",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/StoreCategoryRequest"),
     * ),
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Category"),
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
     * response=409,
     * description="Conflict",
     * ),
     * @OA\Response(
     * response=422,
     * description="Unprocessable Entity",
     * ),
     * @OA\Response(
     * response=401,
     * description="Unauthenticated",
     * ),
     * @OA\Response(
     * response=403,
     * description="Unauthorized",
     * ),
     * @OA\Response(
     * response=500,
     * description="Server Error",
     * ),
     * security={{"bearerAuth": {}}},
     * )
     *  
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreCategoryRequest $request)
    {

        if (!$this->user && !Auth::user()->tokenCan('authToken')) {
            return response()->json(['error' => 'Unauthenficated'], 401);
        }
        try {
            $data = $request->validated();
            $request->merge(['slug' => Str::slug($data['name'], '-'), 'status' => 0]);
            $category = Category::create($request->all());
            return response()->json($category, 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *  path="/api/v1/categories/{id}",
     * operationId="getCategoryById",
     * tags={"Models Categories"},
     * summary="Get category information",
     * description="Returns category data",
     * @OA\Parameter(
     * name="id",
     * description="Category id",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer",
     * format="int64",
     * ),
     * ),
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Category"),
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid ID supplied",
     * ),
     * @OA\Response(
     * response=404,
     * description="Category not found",
     * ),
     * security={{ "bearerAuth": {} }},
     * )
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * @OA\Put(
     *  path="/api/v1/categories/{id}",
     * operationId="updateCategory",
     * tags={"Models Categories"},
     * security={{"bearerAuth": {}}},
     * summary="Update existing category",
     * description="Returns updated category data",
     * @OA\Parameter(
     * name="id",
     * description="Category id",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer",
     * format="int64",
     * ),
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(ref="#/components/schemas/UpdateCategoryRequest"),
     * ),
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Category"),
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid ID supplied",
     * ),
     * @OA\Response(
     * response=404,
     * description="Category not found",
     * ),
     * )
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateCategoryRequest $request, $id)
    {
        //
    }

    /**
     * @OA\Delete(
     * path="/api/v1/categories/{id}",
     * operationId="deleteCategory",
     * tags={"Models Categories"},
     * summary="Delete existing category",
     * description="Deletes a record and returns no content",
     * @OA\Parameter(
     * name="id",
     * description="Category id",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer",
     * format="int64",
     * ),
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
     * description="Category not found",
     * ),
     * security={
     * {{"bearerAuth":{}}},
     * },
     * )
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
    }

    /**
     * @OA\Get(
     *  path="/api/v1/categories/{id}/products",
     * operationId="getProductByCategory",
     * security={{"bearerAuth": {}}},
     * tags={"Models Categories"},
     * summary="Get products by category",
     * description="Returns products by category",
     * @OA\Parameter(
     * name="id",
     * description="Category id",
     * required=true,
     * in="path",
     * @OA\Schema(
     * type="integer",
     * format="int64",
     * ),
     * ),
     * @OA\Response(
     * response=200,
     * description="successful operation",
     * @OA\JsonContent(ref="#/components/schemas/Product"),
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid ID supplied",
     * ),
     * @OA\Response(
     * response=404,
     * description="Category not found",
     * ),
     * 
     * )
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getProductByCategory($id)
    {
        CategoryResource::withoutWrapping();
        return new CategoryResource(Category::find($id)->products()->paginate(10));
    }

     /**
     * @OA\Get(
     *     path="/api/v1/categories/{category:name}/products",
     *    operationId="getProductByCategoryName",
     *    tags={"Models Categories"},
     *    security={{"bearerAuth":{}}},
     *    @OA\Header(header="Authorization", description="Bearer auth token", required=true),
     *    summary="Get products by category",
     *    description="Returns product data",
     *    @OA\Parameter(
     *        name="category",
     *        description="Product category",
     *        required=true,
     *        in="path",
     *        @OA\Schema(
     *            type="string",
     *        )
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Successful operation",
     *        @OA\JsonContent(ref="#/components/schemas/Product"),
     *     ),
     *     @OA\Response(
     *        response=400,
     *        description="Invalid input",
     *     ),
     *     @OA\Response(
     *        response=401,
     *        description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *        response=403,
     *        description="Forbidden",
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="Resource Not Found",
     *     ),
     * )
     *
     * @param [type] $category
     * @return void
     */
    public function getProductByCategoryName($name)
    {
        if(!Auth::check()){
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        if(!Category::where('name', $name)->first()){
            return response()->json(['message' => 'Category not found'], 404);
        }else{
            $products = Category::where('name', $name)->first()->products()->paginate(10);
            return response()->json($products);
        }
       
    }
}

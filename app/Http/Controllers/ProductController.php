<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
   
 
    public function index()
    {
       
    }

  
    public function create()
    {
        //
    }

   
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json(new ProductResource($product));
    }

    
    public function show(Product $product)
    {
       response()->json(new ProductResource($product));
    }

  
    public function edit(Product $product)
    {
        
    }

    
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        $product->update($request->validated());
        return response()->json(new ProductResource($product));

    }

   
    public function destroy(Product $product)
    {
        //
    }

    //generate route  in route api.php
    public function generateRoute($path , $controller , $method , $middleware = null , $prefix = null, $name = null, $namespace = null, $as = null, $domain = null, $where = null, $group = null , $resource = null, $verbe)
    {
        $route = Route::group([
            'prefix' => $prefix,
            'name' => $name,
            'namespace' => $namespace,
            'as' => $as,
            'domain' => $domain,
            'where' => $where,
            'group' => $group,
            'resource' => $resource,
        ], function () use ($path , $controller , $method , $middleware , $verbe , $resource) {
            if($resource == null){
                Route::match([$verbe], $path, $controller . '@' . $method)->middleware($middleware);
            }else{
                Route::apiResource($path, $controller)->middleware($middleware);
            }
        });
        return $route;
    }
   
}

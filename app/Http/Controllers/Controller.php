<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Swagger(
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="apiKey",
 * scheme="bearer",
 * bearerFormat="JWT",
 * ),
 *    schemes={"http","https"},
 *     host="localhost",
 *     basePath="/api/v1",
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Laravel API",
 *         description="Laravel API description",
 *         @OA\Contact(
 *             email="admin@admin.fr"
 *         ),
 *     ),
 *
 * @OA\Server(
 *      url="{schemes}://localhost",
 *      description="Change the host",
 *      @OA\ServerVariable(
 *          serverVariable="schemes",
 *          enum={"https", "http"},
 *          default="http"
 *      )
 * )
 * )
 * @OA\Tag(name="Auth", description="API Endpoints of Auth")
 *  @OA\Tag(name="Models Admins", description="API Endpoints of Admins")
 * @OA\Tag( name="Models Users",   description="API Endpoints of Users" )
 * @OA\Tag(name="Models Roles", description="API Endpoints of Roles")
 * @OA\Tag(name="Models Permissions", description="API Endpoints of Permissions")
 * @OA\Tag(name="Models Categories", description="API Endpoints of Categories")
 * @OA\Tag(name="Models SubCategories", description="API Endpoints of SubCategories")
 * @OA\Tag(name="Models Products", description="API Endpoints of Products")
 * @OA\Tag(name="Models Orders", description="API Endpoints of Orders")
 * @OA\Tag(name="Models OrderItems", description="API Endpoints of OrderItems")
 * @OA\Tag(name="Models Carts", description="API Endpoints of Carts")
 * @OA\Tag(name="Models CartItems", description="API Endpoints of CartItems")
 * @OA\Tag(name="Models Addresses", description="API Endpoints of Addresses")
 * @OA\Tag(name="Models Payments", description="API Endpoints of Payments")
 * @OA\Tag(name="Models Coupons", description="API Endpoints of Coupons")
 * @OA\Tag(name="Models Reviews", description="API Endpoints of Reviews")
 * @OA\Tag(name="Models Wishlists", description="API Endpoints of Wishlists")
 * @OA\Tag(name="Models WishlistItems", description="API Endpoints of WishlistItems")
 * @OA\Tag(name="Models Settings", description="API Endpoints of Settings")
 * @OA\Tag(name="Models Pages", description="API Endpoints of Pages")
 * @OA\Tag(name="Models Sliders", description="API Endpoints of Sliders")
 * @OA\Tag(name="Models Slides", description="API Endpoints of Slides")
 * @OA\Tag(name="Models Menus", description="API Endpoints of Menus")
 * @OA\Tag(name="Models MenuItems", description="API Endpoints of MenuItems")
 * @OA\Tag(name="Models Faqs", description="API Endpoints of Faqs")
 * @OA\Tag(name="Models FaqCategories", description="API Endpoints of FaqCategories")
 * @OA\Tag(name="Models FaqQuestions", description="API Endpoints of FaqQuestions")
 * @OA\Tag(name="Models Brands", description="API Endpoints of Brands")
 * @OA\Tag(name="Models Tags", description="API Endpoints of Tags")
 * @OA\Tag(name="Models Inventories", description="API Endpoints of Inventories")
 * @OA\Tag(name="Models Suppliers", description="API Endpoints of Suppliers")
 * 
 */
class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product model",
 *     @OA\Xml(
 *         name="Product",
 *        namespace="App\Models",

 *    ),
 *
 * )
 */

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];

    /**
     * @OA\Property(
     *     title="id",
     *     description="id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var int
     */
    protected $id;

    /**
     * @OA\Property(
     *     title="name",
     *     description="name",
     *     example="Product name"
     * )
     *
     * @var string
     */
    protected $name;

    /**
     * @OA\Property(
     *     title="description",
     *     description="description",
     *     example="Product description"
     * )
     *
     * @var string
     */
    protected $description;

    /**
     * @OA\Property(
     *     title="created_at",
     *     description="created_at",
     *     format="date-time",
     *     example="2021-01-01 00:00:00"
     * )
     *
     * @var string
     */
    protected $created_at;

    /**
     * @OA\Property(
     *     title="updated_at",
     *     description="updated_at",
     *     format="date-time",
     *     example="2021-01-01 00:00:00"
     * )
     *
     * @var string
     */
    protected $updated_at;

    /**
     * @OA\Property(
     *     title="status",
     *     description="status",
     *     example=true
     * )
     *
     * @var bool
     */
    protected $status;

    /**
     * @OA\Property(
     *     title="price",
     *     description="price",
     *     format="float",
     *     example=100
     * )
     *
     * @var float
     */
    protected $price;

    /**
     * @OA\Property(
     *     title="categories",
     *     description="categories",
     *     example="Product categories"
     * )
     *
     * @var object
     */
    protected $categories;


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    

    
}

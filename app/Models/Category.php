<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Category",
 *     description="Product model",
 *     @OA\Xml(
 *         name="Product",
 *        namespace="App\Models",

 *    ),
 *
 * )
 */

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => \App\Events\CategoryCreated::class,
        'updated' => \App\Events\CategoryUpdated::class,
        'deleted' => \App\Events\CategoryDeleted::class,
    ];

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
     *     example="Category name"
     * )
     *
     * @var string
     */
    protected $name;

    /**
     * @OA\Property(
     *     title="description",
     *     description="description",
     *     example="Category description"
     * )
     *
     * @var string
     */
    protected $description;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories', 'category_id', 'product_id');
    }

   /**
    * get route key name
    */

    public function getRouteKeyName()
    {
        return 'name';
    }
}

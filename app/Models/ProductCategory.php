<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     title="Product Category",
 *     description="Product model",
 *     @OA\Xml(
 *         name="Product Category",
 *        namespace="App\Models",
 *
 *    ),
 *
 * )
 */
class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
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
     *     title="product_id",
     *     description="product_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var int
     */
    protected $product_id;

    /**
     * @OA\Property(
     *     title="category_id",
     *     description="category_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var int
     */
    protected $category_id;

    /**
     * @OA\Property(
     *     title="sub_category_id",
     *     description="sub_category_id",
     *     format="int64",
     *     example=1
     * )
     *
     * @var int
     */
    protected $sub_category_id;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

  
}

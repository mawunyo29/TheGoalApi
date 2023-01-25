<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Supplier",
 *     description="Supplier model",
 *     @OA\Xml(
 *         name="Supplier",
 *        namespace="App\Models",
 *    ),
 * )
 */

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
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
     *     example="Supplier name",
     *     type="string"
     * )
     *
     * @var string
     */
    protected $name;

    /**
     * @OA\Property(
     *     title="description",
     *     description="reference",
     *     example="WxYz"
     * )
     *
     * @var string
     */
    protected $ref;

    /**
     * @OA\Property(
     *     title="status",
     *     description="status",
     *     example=true
     * )
     *
     * @var boolean
     */
    protected $status;

    /**
     * @OA\Property(
     *     title="created_at",
     *     description="created_at",
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
     *     example="2021-01-01 00:00:00"
     * )
     *
     * @var string
     */
    protected $updated_at;

    /**
     * @OA\Property(
     *     title="deleted_at",
     *     description="deleted_at",
     *     example="2021-01-01 00:00:00"
     * )
     *
     * @var string
     */
    protected $deleted_at;



    /**
     * @OA\Property(
     *    title="phone",
     *   description="phone",
     *  example="0606060606",
     * format="string"
     * 
     * )
     * 
     */
    protected $phone;

    /**
     * @OA\Property(
     *    title="address",
     *   description="address",
     *  example="1 rue de la paix",
     * format="string"
     * 
     * )
     * 
     */
    protected $address;


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

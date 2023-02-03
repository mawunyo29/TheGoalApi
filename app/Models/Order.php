<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="Order",
 *     description="Order model",
 *     @OA\Xml(
 *         name="Order",
 *        namespace="App\Models",
 *    ),
 * )
 */
class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
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
     *     example="Order name",
     *     type="string"
     * )
     *
     * @var string
     */
    protected $name;
}

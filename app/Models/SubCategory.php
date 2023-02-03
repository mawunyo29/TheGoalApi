<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="SubCategory",
 *     description="SubCategory model",
 *     @OA\Xml(
 *         name="SubCategory",
 *        namespace="App\Models",
 *    ),
 * )
 */
class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    protected $guarded = [];
}

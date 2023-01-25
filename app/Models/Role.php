<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Role",
 *     description="Role model",
 *     @OA\Xml(
 *         name="Role",
 *        namespace="App\Models",
 *    ),
 * )
 */
class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
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
     *     example="Role name",
     *     type="string"
     * )
     *
     * @var string
     */
    protected $name;

    /**
     * @OA\Property(
     *     title="description",
     *     description="description",
     *     example="Role description",
     * )
     *
     * @var string
     */
    protected $description;

    /**
     * @OA\Property(
     *     title="created_at",
     *     description="created_at",
     *     example="2021-01-01 00:00:00",
     *     type="string",
     *     format="date-time"
     * )
     *
     * @var string
     */
    protected $created_at;

    /**
     * @OA\Property(
     *     title="updated_at",
     *     description="updated_at",
     *     example="2021-01-01 00:00:00",
     *     type="string",
     *     format="date-time"
     * )
     *
     * @var string
     */
    protected $updated_at;

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}

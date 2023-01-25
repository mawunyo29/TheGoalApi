<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CategoryResource.
 *
 * @author  Komla <

 * @OA\Schema(schema="CategoryResource",
 *    title="Category",
 *   description="Category model",
 * ){
 * @OA\Property(property="id", type="integer", format="int64", example=1),
 * @OA\Property(property="name", type="string", example="Category name"),
 * @OA\Property(property="description", type="string", example="Category description"),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2021-01-01 00:00:00"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2021-01-01 00:00:00"),
 * @OA\Property(property="status", type="boolean", example=true),
 * }
 */

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

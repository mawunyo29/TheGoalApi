<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductResource.
 *
 * @author  Komla <
 * @OA\Schema(schema="ProductResource",
 *    title="Product",
 *   description="Product model",
 * ){
 * @OA\Property(property="id", type="integer", format="int64", example=1),
 * @OA\Property(property="name", type="string", example="Product name"),
 * @OA\Property(property="description", type="string", example="Product description"),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2021-01-01 00:00:00"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2021-01-01 00:00:00"),
 * @OA\Property(property="status", type="boolean", example=true),
 * @OA\Property(property="price", type="number", format="float", example=100),
 * }
 */

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'price' => $this->price,
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="UpdateCategoryRequest",
 *     description="Category model",
 *     @OA\Xml(
 *         name="UpdateCategoryRequest",
 *        namespace="App\Http\Requests",
 *    ),
 * ){
 *   @OA\Property(
 *      property="name",
 *    title="name",
 * description="name",
 * example="Category name"
 * ),
 * @OA\Property(
 *   property="description",
 * title="description",
 * description="description",
 * example="Category description"
 * ),
 * }
 */

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}

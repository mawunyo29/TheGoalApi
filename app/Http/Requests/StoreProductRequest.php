<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="StoreProductRequest",
 *     description="Product model",
 *     @OA\Xml(
 *         name="StoreProductRequest",
 *        namespace="App\Http\Requests",

 *    ),
 *
 * ){
 *    @OA\Property(
 *        property="name",
 *       title="name",
 *      description="name",
 *    example="Product name"
 *   ),
 *  @OA\Property(
 *       property="description",
 *     title="description",
 *   description="description",
 * example="Product description"
 * ),
 * @OA\Property(
 *    property="status",
 *   title="status",
 * type="boolean",
 * description="status",
 * example=true
 * ),
 * @OA\Property(
 *   property="price",
 * title="price",
 * type="number",
 * format="float",
 * description="price",
 * example=100.00
 * ),
 * }
 */
class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:products,name,except,id',
            'description' => 'required|string|max:255',
            'status' => 'required|boolean',
            'price' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'description.required' => 'A description is required',
            'status.required' => 'A status is required',
            'price.required' => 'A price is required',
        ];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array<string, mixed>  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        return response()->json([
            'status' => 'error',
            'message' => $errors,
        ], 422);
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'status' => $this->status === 'true',
        ]);
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'name' => 'name',
            'description' => 'description',
            'status' => 'status',
            'price' => 'price',
        ];
    }
    
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="UpdateProduct",
 *     description="Product model",
 *     @OA\Xml(
 *         name="UpdateProduct",
 *        namespace="App\Http\Requests",

 *    ),
 *
 * ){
 *    @OA\Property(
 *        property="id",
 *       title="id",
 *      description="name",
 *    example="1"
 *   ),

 * }
 */
class UpdateProductRequest extends FormRequest
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
            'id' => 'required|integer',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'id.required' => 'id is required',
            'id.integer' => 'id must be integer',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'id' => 'id',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function prepareForValidation()
    {
        return [
            'id' => $this->route('id'),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function validationData()
    {
        return $this->all();
    }

    /**
     * @return response
     */
    public function response(array $errors)
    {
        return response()->json($errors, 422);
    }

    /**
     * @return array<string, mixed>
     */


   

}

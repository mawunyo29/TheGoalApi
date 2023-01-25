<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="StoreCategoryRequest",
 *     description="Category model",
 *     @OA\Xml(
 *         name="StoreCategoryRequest",
 *        namespace="App\Http\Requests",

 *    ),
 *
 * ){
 *    @OA\Property(
 *        property="name",
 *       title="name",
 *      description="name",
 *    example="Category name"
 *   ),
 *  @OA\Property(
 *       property="description",
 *     title="description",
 *   description="description",
 * example="Category description"
 * ),
 * }
 */

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'Le champ :attribute est obligatoire',
            'description.required' => 'Le champ :attribute  est obligatoire',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'name' => 'Nom',
            'description' => 'Description',
        ];
    }



     public function prepareforValidation()
     {
         $this->merge([
             'name' => $this->name,
             'description' => $this->description,
         ]);
     }

     public function response(array $errors)
     {
         return response()->json([
             'status' => 'error',
             'message' => $errors,
         ], 422);
     }

     public function withValidator($validator)
     {
         $validator->after(function ($validator) {
             if ($this->name == 'foo') {
                 $validator->errors()->add('name', 'Name is invalid');
             }
         });
     }
    


}

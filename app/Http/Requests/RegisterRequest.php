<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(schema="RegisterRequest",
 *      title="Register Request",
 *      description="Register Request body data",
 *      type="object",
 *      required={"name", "email", "password"}
 * ){
 *     @OA\Property(property="name", type="string", format="name", example="mawunyo"),
 *     @OA\Property(property="email", type="string", format="email", example="admin@admin.fr"),
 *   @OA\Property(property="password", type="string", format="password", example="password"),
 * }
 */
class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
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
            'name.required' => 'A :attribute is required',
            'email.required' => 'A :attribute is required',
            'password.required' => 'A :attribute is required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'name' => 'user name',
            'email' => 'user email',
            'password' => 'user password',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Schema(
 *     title="StoreSupplierRequest",
 *     description="Supplier model",
 *     @OA\Xml(
 *         name="StoreSupplierRequest",
 *        namespace="App\Http\Requests",
 *    ),
 * ){
 *   @OA\Property(
 *      property="name",
 *    title="name",
 * description="name",
 * example="Supplier name"
 * ),
 * @OA\Property(
 *   property="email",
 * title="email",
 * description="email",
 * example="myemail@mydomain.fr",
 * type="string",
 * format="email"
 * ),
 * @OA\Property(
 *  property="phone",
 * title="phone",
 * description="phone",
 * example="0123456789",
 * type="string",
 * format="phone"
 * ),
 * @OA\Property(
 * property="address",
 * title="address",
 * description="address",
 * example="My address",
 * type="string",
 * format="address"
 * ),
 * @OA\Property(
 * property="city",
 * title="city",
 * description="city",
 * example="My city",
 * type="string",
 * 
 * ),
 * @OA\Property(
 * property="zip_code",
 * title="zip_code",
 * description="zip_code",
 * example="12345",
 * type="string",
 * format="zip code"
 * ),
 * @OA\Property(
 * property="country",
 * title="country",
 * description="country",
 * example="My country",
 * type="string",
 * 
 * ),
 * @OA\Property(
 * property="status",
 * title="status",
 * description="status",
 * example=true,
 * type="boolean",
 * ),
 * @OA\Property(
 * property="ref",
 * title="ref",
 * description="ref",
 * example="WxYz",
 * type="string",
 * ),
 * 
 * }
 */

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            return true;
        }
        return  response()->json(['error' => 'Unauthorized'], 401);
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
            'email' => 'required|string|email|max:255|unique:suppliers',
            'phone' => 'required|string|max:255|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'status' => 'required|boolean',
            'ref' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'A :attribute is required',
            'email.required' => 'A :attribute is required',
            'phone.required' => 'A :attribute is required',
            'address.required' => 'A :attribute is required',
            'city.required' => 'A :attribute is required',
            'zip_code.required' => 'A :attribute is required',
            'country.required' => 'A :attribute is required',
            'status.required' => 'A :attribute is required',
            'ref.required' => 'A :attribute is required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'name' => 'name',
            'email' => 'email',
            'phone' => 'phone',
            'address' => 'address',
            'city' => 'city',
            'zip_code' => 'zip code',
            'country' => 'country',
            'status' => 'status',
            'ref' => 'ref',
        ];
    }

    /**
     * Get the validation data from the request.
     *
     * @return array<string, mixed>
     */
    protected function prepareForValidation()
    {
        if (Auth::check()) {
            $data = $this->all();
            $data['status'] = $this->boolean('status');
            return $data;
        } else {
            return response()->json(['error' => 'Unauthorized  you mast log in'], 401);
        }
    }

    /**
     * Get the validation data from the request.
     *
     * @return array<string, mixed>
     */
    protected function failedValidation(Validator $validator)
    {
        if (Auth::check()) {
            $errors = $validator->errors();
            $response = response()->json(['errors' => $errors], 422);
            throw new \Illuminate\Validation\ValidationException($validator, $response);
        } else
            $response = response()->json(['error' => 'Unauthorized  you mast log in'], 401);
    }

    /**
     * Get the validation data from the request.
     *
     * @return array<string, mixed>
     */
    protected function failedAuthorization()
    {
        if (Auth::check()) {
            $response = response()->json(['error' => 'Unauthorized'], 401);
            throw new \Illuminate\Auth\Access\AuthorizationException($response);
        } else
            $response = response()->json(['error' => 'Unauthorized  you mast log in'], 401);
    }
}

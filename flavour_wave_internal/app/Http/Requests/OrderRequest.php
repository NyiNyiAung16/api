<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'preorder_id' => ['required',Rule::exists('preorders','id')],
            'location' => 'required',
            'order_quantity' => 'required',
            'product_name' => 'required'
        ];
    }

    public function failedValidation(Validator $valitor){
        $errors = $valitor->errors();
        throw new HttpResponseException(response()->json(['errors'=>$errors]));
    }
}

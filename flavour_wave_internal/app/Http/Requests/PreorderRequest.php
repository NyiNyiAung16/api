<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PreorderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required',Rule::exists('users','user_id')] ,
            'location' => 'required',
            'order_quantity' => 'required'
        ];
    }

    public function failedValidation(Validator $valitor){
        $errors = $valitor->errors();
        throw new HttpResponseException(response()->json(['errors'=>$errors]));
    }
}

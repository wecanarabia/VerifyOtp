<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'sometimes|nullable|min:0|max:255',
            'wecan_id' => 'sometimes|nullable|min:0|max:255',
            'email' => 'sometimes|min:3|max:255|unique:users,email,'.$this->id,
            'password' => ['sometimes',Password::min(8)],
            'phone' => 'sometimes|min:9|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone,'.$this->id,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(['status' => false, 'code'=>400, 'errors' =>$errors])
        );

    }
}

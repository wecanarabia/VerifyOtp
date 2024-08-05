<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
class SubscriptionRequest extends FormRequest
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
            "user_id" => "sometimes|exists:users,id",
            "type" => "sometimes|in:email,whatsapp,both",
            "app_name" => "sometimes|string|min:3",
            "number_of_messages" => "sometimes|integer|min:0",
            "number_of_digits" => "sometimes|integer|in:4,5,6",
            "number_of_minutes" => "sometimes|integer|min:1,max:10",
            "unformal_whatsapp_token" => "sometimes|min:0",
            "unformal_whatsapp_instance_id" => "sometimes|min:0",
            "start_date" => "sometimes|date_format:Y-m-d",
            "end_date" => "sometimes|date_format:Y-m-d",
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

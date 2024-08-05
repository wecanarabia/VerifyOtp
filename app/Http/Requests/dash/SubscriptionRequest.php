<?php

namespace App\Http\Requests\dash;

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
            "app_name" => "sometimes|string|min:3",
            "number_of_digits" => "sometimes|integer|in:4,5,6",
            "number_of_digits" => "sometimes|integer|min:1,max:10",
        ];
    }
}

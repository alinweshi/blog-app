<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends ApiFormRequest
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
            'title' => 'required|string|max:255',
            'description' => [
                'required|string|max:2048',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (strlen($value) > 2048) {
                        $fail("The {$attribute} must not exceed 2048 characters.");
                    }
                },
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\CarStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['sometimes', Rule::in(CarStatus::cases(), 'value')],
            'make' => ['sometimes', 'string'],
            'model' => ['sometimes', 'string'],
        ];
    }
}

<?php

namespace Zerp\ExamplePackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamplePackageItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }
}
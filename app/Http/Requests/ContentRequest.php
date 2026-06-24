<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'json' => ['nullable'],
            'files' => ['required', 'array'],
            'files.*' => ['file', 'mimes:jpeg,jpg,png,mp4,webp', 'max:100048'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

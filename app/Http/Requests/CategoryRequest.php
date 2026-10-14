<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() === true;
    }

    public function rules(): array
    {
        $category = this->route('category');
            return ['name' => [
                'required',
                'string',
                'min:3',
                'max:100',

            Rule::unique('categories', 'name')->ignore(category),

            ],
        ];
    }

   
}

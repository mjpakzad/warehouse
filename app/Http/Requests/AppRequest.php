<?php

namespace App\Http\Requests;

use App\Rules\ValidArticles;
use App\Rules\ValidProducts;
use Illuminate\Foundation\Http\FormRequest;

class AppRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'articles'  => ['required', 'file', 'mimes:json', new ValidArticles],
            'products'  => ['required', 'file', 'mimes:json', new ValidProducts($this->all())],
        ];
    }
}

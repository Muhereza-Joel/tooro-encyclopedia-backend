<?php

namespace App\Filament\Resources\ArticleResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
			'title' => 'required',
			'slug' => 'required',
			'summary' => 'required|string',
			'content' => 'required',
			'image' => 'required',
			'author_id' => 'required',
			'published_at' => 'required',
			'is_featured' => 'required',
			'tags' => 'required',
			'category_id' => 'required'
		];
    }
}

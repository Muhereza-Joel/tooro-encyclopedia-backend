<?php

namespace App\Filament\Resources\ArtifactResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArtifactRequest extends FormRequest
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
			'name' => 'required',
			'description' => 'required|string',
			'material' => 'required',
			'origin' => 'required',
			'use_case' => 'required|string',
			'image_path' => 'required',
			'category' => 'required',
			'preservation_status' => 'required',
			'location' => 'required'
		];
    }
}

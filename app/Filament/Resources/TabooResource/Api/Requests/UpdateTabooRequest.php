<?php

namespace App\Filament\Resources\TabooResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTabooRequest extends FormRequest
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
			'description' => 'required|string',
			'reason' => 'required|string',
			'consequence' => 'required|string',
			'applies_to' => 'required',
			'clan_id' => 'required',
			'category' => 'required'
		];
    }
}

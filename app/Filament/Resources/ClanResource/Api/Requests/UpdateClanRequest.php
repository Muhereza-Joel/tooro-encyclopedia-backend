<?php

namespace App\Filament\Resources\ClanResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClanRequest extends FormRequest
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
			'totem' => 'required',
			'description' => 'required|string',
			'origin' => 'required|string',
			'leader_title' => 'required',
			'notable_members' => 'required|string'
		];
    }
}

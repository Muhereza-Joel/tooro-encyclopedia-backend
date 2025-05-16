<?php

namespace App\Filament\Resources\EventResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
			'location' => 'required',
			'start_time' => 'required',
			'end_time' => 'required',
			'price' => 'required|numeric',
			'capacity' => 'required'
		];
    }
}

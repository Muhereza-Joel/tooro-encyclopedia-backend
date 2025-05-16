<?php

namespace App\Filament\Resources\TransactionResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
			'currency' => 'required',
			'amount' => 'required|numeric',
			'status' => 'required',
			'referenceNo' => 'required',
			'trackingId' => 'required',
			'paymentMethod' => 'required',
			'booking_id' => 'required'
		];
    }
}

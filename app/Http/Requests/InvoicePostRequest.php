<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoicePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customerId' => 'required|integer',
            'fromDate' => 'required|date',
            'toDate' => 'required|date',
            'sales' => 'required|array',
            'sales.*.orderDate' => 'required|date',
            'sales.*.itemName' => 'required|string',
            'sales.*.itemPrice' => 'required|integer',
            'sales.*.quantity' => 'required|integer',
            'sales.*.memo' => 'nullable|string',
            'sales.*.amount' => 'required|integer',
            'sales.*.taxPrice' => 'required|integer',
        ];
    }
}

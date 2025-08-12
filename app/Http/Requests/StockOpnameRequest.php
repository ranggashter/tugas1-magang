<?php
// app/Http/Requests/StockOpnameRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOpnameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'actual_stock' => ['required', 'integer', 'min:0'],
            'date' => ['required', 'date'],
            'note' => ['nullable', 'string'],
        ];
    }
}
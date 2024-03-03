<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRequest extends FormRequest
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
            'receiver_id' => 'required|email|exists:users,email',
            'amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'receiver_id.required' => 'This field is required',
            'receiver_id.email' => 'Invalid email id passed',
            'receiver_id.exists' => 'Email id does not exists',
            'amount.required' => 'Please enter the amount',
            'amount.numeric' => 'Please enter the valid amount in numbers only',
        ];
    }
}

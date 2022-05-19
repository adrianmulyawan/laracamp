<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        // Ambil data bulan dan tahun sekarang
        // $expiredValidation = date('Y-m', time());

        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id.',id',
            'occupation' => 'required|string',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'discount' => 'nullable|string|exists:discounts,code,deleted_at,NULL',
        ];
    }
}

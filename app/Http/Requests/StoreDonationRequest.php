<?php

namespace App\Http\Requests;

use App\Rules\DonationAmount;
use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
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
        return [
            "name" => "required|min:1|max:100",
            "email" => "required|email",
            "amount" => [
                "required",
                new DonationAmount()
            ],
            "message" => "nullable|max:200"
        ];
    }
}

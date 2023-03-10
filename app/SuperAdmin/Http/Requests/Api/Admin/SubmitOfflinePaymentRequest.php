<?php

namespace App\SuperAdmin\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubmitOfflinePaymentRequest extends FormRequest
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
     * Get the validation rules that apply to the request.  submit_description
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'phone_number' => 'required',
            'subscription_plan_id' => 'required',
            'plan_type' => 'required',
        ];

        return $rules;
    }
}

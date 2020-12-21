<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingUpdateRequest extends FormRequest
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
            'video' => 'nullable|string|min:2|max:191',
            'feature_one' => 'nullable|string|min:2|max:191',
            'feature_two' => 'nullable|string|min:2|max:191',
            'feature_three' => 'nullable|string|min:2|max:191',
            'feature_four' => 'nullable|string|min:2|max:191',
            'why_works' => 'nullable|string|min:2|max:64000',
            'email' => 'required|string|email|max:191',
            'phone' => 'nullable|string|min:5|max:15'
        ];
    }
}

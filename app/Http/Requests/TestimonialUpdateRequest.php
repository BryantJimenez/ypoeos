<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TestimonialUpdateRequest extends FormRequest
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
            'implementer_id' => 'required',
            'name' => 'required|string|min:2|max:191',
            'title' => 'nullable|string|min:2|max:191',
            'testimonial' => 'required|string|min:2|max:1000'
        ];
    }
}

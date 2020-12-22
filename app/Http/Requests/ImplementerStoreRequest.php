<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ImplementerStoreRequest extends FormRequest
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
      'photo' => 'nullable|file|mimetypes:image/*',
      'name' => 'required|string|min:2|max:191',
      'lastname' => 'required|string|min:2|max:191',
      'title' => 'required|string|min:2|max:191',
      'phone' => 'required|string|min:5|max:20',
      'address' => 'required|string|min:2|max:191',
      'lat' => 'required|string|min:2|max:191',
      'lng' => 'required|string|min:2|max:191',
      'experience' => 'required|string|min:2|max:5000',
      'email' => 'required|string|email|max:191|unique:users,email',
      'ypo_url' => 'nullable|string|min:2|max:191',
      'facebook' => 'nullable|string|min:2|max:191',
      'twitter' => 'nullable|string|min:2|max:191',
      'linkedin' => 'nullable|string|min:2|max:191'
    ];
  }
}

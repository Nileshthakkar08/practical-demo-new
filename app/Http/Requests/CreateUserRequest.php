<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'profile_photo' => 'required',
            'hobbies' => 'required',
            'gender' => 'required',
            'state_id' => 'required',
            'city_id' => 'required'
        ];
    }
}

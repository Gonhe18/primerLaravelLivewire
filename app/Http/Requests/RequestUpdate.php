<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules($user)
    {
        $values =  [
            'name' => 'required|min:3|max:30',
            'apellido' => 'required|min:3|max:30',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
            'role' => 'required|in:cliente,admin,vendedor',
            'profile_photo_path' => 'nullable|image'
        ];

        if (!$user) {
            $validation_password = [
                'password' => 'required|confirmed',
            ];
            $values = array_merge($values, $validation_password);
        }


        return $values;
    }
}
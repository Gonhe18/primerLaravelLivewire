<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|min:3|max:30',
            'apellido' => 'required|min:3|max:30',
            'email' => 'required|email',
            'role' => 'required|in:cliente,admin,vendedor',
        ];
    }
}
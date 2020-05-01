<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = User::where('email', $this->request->get('email'))->where('phone', $this->request->get('phone'))->first();
        if ($this->request->has('old_password')) {
            return [
                'old_password' => 'sometimes|required|min:7',
                'new_password' => 'sometimes|required|min:8',
                'confirm_password' => 'sometimes|required_with:new_password|min:8|same:new_password',
            ];
        } else {
            return [
                'name' => 'required|min:2|max:100',
                'email' => 'required|unique:users,email,' . optional($user)->id . ',id,deleted_at,NULL|min:2|max:255',
                'phone' => 'required|digits:10|unique:users,phone,' . optional($user)->id . ',id',
                'team' => 'required|numeric|exists:teams,id,deleted_at,NULL',
                'gender' => 'required|in:Male,Female',
                'food' => 'required',
            ];
        }
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'food.required' => 'Please select breakfast or lunch or both',
        ];
    }
}

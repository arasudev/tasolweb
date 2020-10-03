<?php

namespace App\Http\Requests;

use App\Menu;
use Illuminate\Foundation\Http\FormRequest;

class MenuSettingRequest extends FormRequest
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
            'breakfast_menu' => 'required|exists:menus,id,deleted_at,NULL',
            'lunch_menu_one' => 'required|exists:menus,id,deleted_at,NULL',
            'lunch_menu_two' => 'required_unless:lunch_menu_one,' . Menu::getRice()->id . '|different:lunch_menu_one',
        ];
    }
}

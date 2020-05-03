<?php

namespace App\Http\Requests;

use App\Menu;
use Illuminate\Foundation\Http\FormRequest;

class UserBreakfastRequest extends FormRequest
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
        $rule = [];
        $countMultiple = 'min:0|max:10';
        $countIndividual = 'max:1';
        $menus = Menu::where('type', BREAKFAST_MENU)->get();
        foreach ($menus as $menu) {
            $rule[$menu->slug] = 'nullable|' . ($menu->bill_type === BILL_TYPE_INDIVIDUAL ? $countIndividual : $countMultiple);
        }
        return $rule;
    }
}

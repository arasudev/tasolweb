<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuSettingRequest;
use App\Menu;
use App\Setting;
use Illuminate\Http\Request;

class MenuSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::with('breakfast_menu', 'lunch_menu_one', 'lunch_menu_two')->get();
        return view('menu_settings.index', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::with('breakfast_menu', 'lunch_menu_one', 'lunch_menu_two')->findOrFail($id);
        $menus = Menu::all();
        $riceMenuId = Menu::getRice()->id;
        return view('menu_settings.edit', compact('setting', 'menus', 'riceMenuId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(MenuSettingRequest $request, $id)
    {
        $setting = Setting::findOrFail($id);
        $setting->breakfast_menu_id = $request->breakfast_menu;
        $setting->lunch_menu_id_one = $request->lunch_menu_one;
        if ($request->lunch_menu_one !== Menu::getRice()->id) {
            $setting->lunch_menu_id_two = $request->lunch_menu_two;
        }
        $setting->save();
        return redirect('/menu-settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

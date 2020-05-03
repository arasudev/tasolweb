<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserBreakfastRequest;
use App\Menu;
use App\User;
use App\UserMenu;
use Illuminate\Http\Request;

class UserBreakfastController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menus = auth()->user()->breakfast_menus;
        return view('breakfast_menu_settings.show', compact('menus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = auth()->user()->breakfast_menus;
        return view('breakfast_menu_settings.update', compact('menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserBreakfastRequest $request, $id)
    {
        foreach ($request->all() as $key => $value) {
            $menu = Menu::where('slug', $key)->first();
            if ($menu) {
                UserMenu::where('menu_id', $menu->id)->where('user_id', auth()->user()->id)
                    ->update([
                        'count' => $value ?? null,
                    ]);
            }
        }
        return redirect('/breakfasts/' . auth()->user()->id);
    }
}

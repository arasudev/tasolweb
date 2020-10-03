@extends('layouts.app')

@section('title')
    Daily Menu Settings - {{ ucfirst($setting->day) }}
@endsection

@section('content')
    <span class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-7">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Update Setting</h2>
                </div>
                <div class="card-body">
                    <form class="horizontal-form" method="post" action="/menu-settings/{{ $setting->id }}">
                        @csrf
                        @method('PATCH')
                        @if($errors->any())
                            <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        @foreach ($errors->all() as $error)
                                            <span style="color: red">* {{ $error }}</span><br>
                                        @endforeach
                                    </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-12 col-md-4 text-right pt-1">
                                <label style="font-size: 20px" for="breakfast_menu">
                                    Breakfast :
                                </label>
                            </div>
                            <div class="col-10 col-md-7">
                                <select name="breakfast_menu" class="form-control" id="breakfast_menu">
                                    @foreach($menus as $menu)
                                        @if($menu->type == BREAKFAST_MENU)
                                            <option value="{{ $menu->id }}" @if($setting->breakfast_menu->id == $menu->id) selected @endif>{{ ucfirst($menu->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-4 text-right pt-1">
                                <label style="font-size: 20px" for="lunch_menu_one">
                                    Lunch Menu One :
                                </label>
                            </div>
                            <div class="col-10 col-md-7">
                                <select name="lunch_menu_one" class="form-control" id="lunch_menu_one">
                                    @foreach($menus as $menu)
                                        @if($menu->type == LUNCH_MENU)
                                            <option value="{{ $menu->id }}" @if($setting->lunch_menu_one->id == $menu->id) selected @endif>{{ ucfirst($menu->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-4 text-right pt-1">
                                <label style="font-size: 20px" for="lunch_menu_two">
                                    Lunch Menu Two :
                                </label>
                            </div>
                            <div class="col-10 col-md-7">
                                <select name="lunch_menu_two" class="form-control" id="lunch_menu_two">
                                    <option value="" @if(!$setting->lunch_menu_two) selected @endif>None</option>
                                    @foreach($menus as $menu)
                                        @if($riceMenuId != $menu->id && $menu->type == LUNCH_MENU)
                                            <option value="{{ $menu->id }}" @if(optional($setting->lunch_menu_two)->id == $menu->id) selected @endif>{{ ucfirst($menu->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button class="btn btn-primary" type="submit">Update Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </span>
@endsection


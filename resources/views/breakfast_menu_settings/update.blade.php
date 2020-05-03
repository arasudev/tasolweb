@extends('layouts.app')

@section('title')
    Update {{ auth()->user()->name }}'s Breakfast Details
@endsection

@section('content')
    <span class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-7">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Update Breakfast Details</h2>
                </div>
                <div class="card-body">
                    <form class="horizontal-form" method="post" action="/breakfasts/{{ auth()->user()->id }}">
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
                        @foreach($menus as $menu)
                            <div class="form-group row">
                                <div class="col-12 col-md-4 text-right pt-1">
                                    <label style="font-size: 20px" for="{{ $menu->slug }}">
                                        {{ $menu->name }} <span style="font-size: 15px">(1 * ₹{{ $menu->price }}){{ $menu->bill_type === BILL_TYPE_INDIVIDUAL ? '(appx)' : '' }} </span> :
                                    </label>
                                </div>
                                <div class="col-10 col-md-7">
                                    <select name="{{ $menu->slug }}" class="form-control" id="{{ $menu->slug }}">
                                        <option value="" {{ $menu->pivot->count == null ? 'selected' : '' }}>Not Needed</option>
                                        @if($menu->bill_type === BILL_TYPE_INDIVIDUAL)
                                            <option value="1" {{ $menu->pivot->count == 1 ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ $menu->pivot->count == 2 ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ $menu->pivot->count == 3 ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ $menu->pivot->count == 4 ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ $menu->pivot->count == 5 ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ $menu->pivot->count == 6 ? 'selected' : '' }}>6</option>
                                            <option value="7" {{ $menu->pivot->count == 7 ? 'selected' : '' }}>7</option>
                                            <option value="8" {{ $menu->pivot->count == 8 ? 'selected' : '' }}>8</option>
                                            <option value="9" {{ $menu->pivot->count == 9 ? 'selected' : '' }}>9</option>
                                            <option value="10" {{ $menu->pivot->count == 10 ? 'selected' : '' }}>10</option>
                                        @else
                                            <option value="1" {{ $menu->pivot->count == 1 ? 'selected' : '' }}>Needed (1)</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <div class="text-right">
                            <button class="btn btn-primary" type="submit">Update Breakfast Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </span>
@endsection


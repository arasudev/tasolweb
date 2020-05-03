@extends('layouts.app')

@section('title')
    Create User
@endsection

@section('content')
    <span class="row">
        <div class="col-lg-3"></div>
        <span class="col-lg-6">
            <span class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Create User</h2>
                </div>
                <span class="card-body">
                    <form method="POST" action="/users">
                        @csrf
                        @if($errors->any())
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    @foreach ($errors->all() as $error)
                                        <span style="color: red">* {{ $error }}</span><br>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}" required min="2" max="100">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="phone">Contact Number</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Mobile Number" required minlength="10" value="{{ old('phone') }}" maxlength="10">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="team">team</label>
                                <select name="team" class="form-control" id="team" required>
                                    <option value="">please select a team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ old('team') == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" id="gender" required>
                                    <option value=""> please select a gender</option>
                                    <option value="{{ GENDER_MALE }}" {{ old('gender') == GENDER_MALE ? 'selected' : '' }}>{{ GENDER_MALE }}</option>
                                    <option value="{{ GENDER_FEMALE }}" {{ old('gender') == GENDER_FEMALE ? 'selected' : '' }}>{{ GENDER_FEMALE }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label class="control outlined control-checkbox checkbox-success">Breakfast
                                    <input name="food[breakfast]" type="checkbox" />
                                    <div class="control-indicator"></div>
                                </label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="control outlined control-checkbox checkbox-success">Lunch
                                    <input name="food[lunch]" type="checkbox" />
                                    <div class="control-indicator"></div>
                                </label>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary" type="submit">Create User</button>
                        </div>
                    </form>
                </span>
            </span>
        </span>
    </span>
@endsection


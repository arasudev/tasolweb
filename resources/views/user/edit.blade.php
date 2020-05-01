@extends('layouts.app')

@section('title')
    Edit {{ $user->name }}'s Details
@endsection

@section('content')
    <span class="row">
        <div class="col-lg-3"></div>
        <span class="col-lg-6">
            <span class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Edit User</h2>
                </div>
                <span class="card-body">
                    <form method="POST" action="/users/{{ $user->id }}">
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
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="{{ old('name') ?? ($user->name ?? '') }}" required min="2" max="100">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') ?? ($user->email ?? '') }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="phone">Contact Number</label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Mobile Number" required minlength="10" value="{{ old('phone') ?? ($user->phone ?? '') }}" maxlength="10">
                            </div>
                        </div>
                        @php
                            $selectedTeam = old('team') ?? ($user->team_id ?? '');
                            $selectedGender = old('gender') ?? ($user->gender ?? '');
                        @endphp
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="team">team</label>
                                <select name="team" class="form-control" id="team" required>
                                    <option value="">please select a team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $selectedTeam == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control" id="gender" required>
                                    <option value=""> please select a gender</option>
                                    <option value="Male" {{ $selectedGender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $selectedGender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label class="control outlined control-checkbox checkbox-success">Breakfast
                                    <input name="food[breakfast]" type="checkbox" {{ $user->breakfast ? 'checked' : '' }} />
                                    <div class="control-indicator"></div>
                                </label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="control outlined control-checkbox checkbox-success">Lunch
                                    <input name="food[lunch]" type="checkbox" {{ $user->lunch ? 'checked' : '' }} />
                                    <div class="control-indicator"></div>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update User</button>
                    </form>
                </span>
            </span>
        </span>
    </span>
@endsection


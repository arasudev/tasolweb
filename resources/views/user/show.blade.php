@extends('layouts.app')

@section('title')
    {{ $user->name }}'s Profile
@endsection

@section('content')
    <div class="bg-white border rounded">
        <div class="row">
            <div class="col-lg-4 col-xl-5">
                <div class="profile-content-left pt-5 pb-3 px-3 px-xl-5">
                    <div class="card text-center widget-profile px-0 border-0">
                        <div class="card-img mx-auto rounded-circle">
                            <img src="{{ $user->photo }}" alt="{{ $user->name }}" width="100%">
                        </div>
                        <div class="card-body">
                            <h4 class="py-2 text-dark">{{ $user->name }}</h4>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <hr class="w-100">
                    <div class="contact-info pt-4">
                        <h5 class="text-dark mb-1">Contact Information</h5>
                        <p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
                        <p>{{ $user->email }}</p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
                        <p>{{ $user->phone }}</p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">Breakfast</p>
                        <p><strong>{{ $user->breakfast ? 'YES' : 'NO' }}</strong></p>
                        <p class="text-dark font-weight-medium pt-4 mb-2">Lunch</p>
                        <p><strong>{{ $user->lunch ? 'YES' : 'NO' }}</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-7">
                <div class="profile-content-right py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="true">Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                            <div class="media mt-5 profile-timeline-media">
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
                                            <label for="old_password">Old Password</label>
                                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password" required>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="password">New Password</label>
                                            <input type="password" name="new_password" class="form-control" id="password" placeholder="New Password"required min="8">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password"required min="8">
                                        </div>
                                    </div>
                                    <button class="btn btn-block btn-outline-info" type="submit">Change Password</button>
                                    <br><br><br><br><br><br><br><br><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
@endsection


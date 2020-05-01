@extends('layouts.app')

@section('title')
    Contacts
@endsection

@section('content')
    <div class="row">
        @foreach($users as $user)
            <div class="col-lg-6 col-xl-4">
                <div class="card card-default p-4">
                    <a href="javascript:0" class="media text-secondary" data-toggle="modal" data-target="#modal-contact">
                        <img src="{{ $user->photo }}" class="mr-3 img-fluid rounded" alt="{{ $user->gender }}" width="30%">
                        <div class="media-body">
                            <h5 class="mt-0 mb-2 text-dark">{{ $user->name }}</h5>
                            <ul class="list-unstyled">
                                <li class="d-flex mb-1">
                                    <i class="mdi mdi-email mr-1"></i>
                                    <span>{{ $user->email }}</span>
                                </li>
                                <li class="d-flex mb-1">
                                    <i class="mdi mdi-phone mr-1"></i>
                                    <span>{{ $user->phone }}</span>
                                </li>
                                <li class="d-flex mb-1">
                                    <i class="mdi mdi-food-fork-drink mr-1"></i>
                                    <span>Breakfast : <strong>{{ $user->breakfast ? 'Yes' : 'No' }}</strong></span>
                                </li>
                                <li class="d-flex mb-1">
                                    <i class="mdi mdi-food-variant mr-1"></i>
                                    <span>Lunch : <strong>{{ $user->lunch ? 'Yes' : 'No' }}</strong></span>
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

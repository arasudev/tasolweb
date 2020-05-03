@extends('layouts.app')

@section('title')
    {{ auth()->user()->name }}'s Breakfast Details
@endsection

@section('content')
    <span class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="col-lg-12">
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h2>Breakfast Details
                                                <button type="button" class="mb-1 btn btn-sm btn-outline-info" onclick="window.location.href='/breakfasts/' + {{ auth()->user()->id }} + '/edit'">Edit<i class="mdi mdi-pencil pl-1"></i></button>
                                            </h2>
										</div>
										<div class="card-body">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col">Menu Name</th>
														<th scope="col">Count</th>
														<th scope="col">Cost</th>
													</tr>
												</thead>
												<tbody>
                                                @foreach($menus as $menu)
                                                    <tr>
														<td>{{ $menu->name }}</td>
														<td>{{ $menu->bill_type === BILL_TYPE_INDIVIDUAL ?
                                                            ($menu->pivot->count ?? '-') : ($menu->pivot->count ? ($menu->pivot->count . ' (Appx)') : '-') }}</td>
                                                        <td>{{ $menu->bill_type === BILL_TYPE_INDIVIDUAL ?
                                                            (($menu->pivot->count) ? ($menu->pivot->count * $menu->price) : '-') : ($menu->pivot->count ? (($menu->pivot->count * $menu->price) . ' (Appx)') : '-') }}</td>
													</tr>
                                                @endforeach
												</tbody>
											</table>
										</div>
									</div>

								</div>
        </div>
    </span>
@endsection


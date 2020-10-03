@extends('layouts.app')

@section('title')
    Daily Menu Settings
@endsection

@section('content')
    <span class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="col-lg-12">
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h2>Breakfast Details</h2>
										</div>
										<div class="card-body">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col">Day</th>
														<th scope="col">Breakfast</th>
														<th scope="col">Lunch</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
                                                @foreach($settings as $setting)
                                                    @php
                                                        $lunch = ucfirst($setting->lunch_menu_one->name);
                                                        if ($setting->lunch_menu_two) {
                                                            $lunch .= ' & ' . ucfirst($setting->lunch_menu_two->name);
                                                        }
                                                    @endphp
                                                    <tr>
														<td>{{ ucfirst($setting->day) }}</td>
														<td>{{ ucfirst($setting->breakfast_menu->name) }}</td>
														<td>{{ $lunch }}</td>
														<td><button type="button" class="mb-1 btn btn-sm btn-outline-info" onclick="window.location.href='/menu-settings/' + {{ $setting->id }} + '/edit'">Edit</button></td>
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


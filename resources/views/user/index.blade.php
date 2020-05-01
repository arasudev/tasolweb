@extends('layouts.app')

@section('title')
    User
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Users Table</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Team</th>
                                <th scope="col">Email</th>
                                <th scope="col">phone</th>
                                <th scope="col">Breakfast</th>
                                <th scope="col">Lunch</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->team->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->breakfast ? 'Yes' : 'No' }}</td>
                                <td>{{ $user->lunch ? 'Yes' : 'No' }}</td>
                                <td>
                                    <button type="button" class="mb-1 btn btn-sm btn-outline-info" onclick="window.location.href='/users/' + {{ $user->id }} + '/edit'"><i class="mdi mdi-pencil"></i></button>
                                    <button type="button" class="mb-1 btn btn-sm btn-outline-danger" onclick='deleteUser("{{ $user->id }}", "{{ $user->name }}")'><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteUser(id, name) {
            swal({
                title: "Are you sure to delete '" + name + "'?",
                text: "Once deleted, you will not be able to recover",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '/users/' + id,
                            method: 'delete',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                swal({
                                    title: name + " Deleted Successfully!",
                                    text: " ",
                                    icon: "success",
                                    buttons: false,
                                });
                                swal.close();
                                location.reload();
                            },
                            error: function (response) {
                                swal({
                                    title: "Warning!",
                                    text: "Unable to delete the User",
                                    icon: "warning",
                                });
                            },
                        });
                    }
                });
        }
    </script>
@endsection


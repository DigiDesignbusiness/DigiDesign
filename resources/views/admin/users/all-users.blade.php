@component('admin.layouts.content')

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.deletebtn').click(function(e) {
                    e.preventDefault();

                    var delete_id = $(this).closest("tr").find('.delete_val_id').val();
                    swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this imaginary file!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                var data = {
                                    "_token": $('input[name=_token]').val(),
                                    "id": delete_id
                                };

                                $.ajax({
                                    type: "DELETE",
                                    url: "/admin/delete-user/" + delete_id,
                                    data: data,
                                    success: function(response) {
                                        swal(response.status, {
                                                icon: "success",
                                            })
                                            .then((result) => {
                                                location.reload();
                                            })
                                    }
                                });
                            }
                        });
                })
            });
        </script>
    @endsection

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Users List</h4>
                    <div>
                        @can('create-user')
                            <a class="nav-link btn btn-success" href="{{ route('create-user') }}">Create user</a>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Address </th>
                                <th> Email Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <input type="hidden" class="delete_val_id" value="{{ $user->id }}">
                                    <td> {{ $user->id }} </td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->phone }} </td>
                                    <td> {{ $user->address }} </td>
                                    <td>
                                        @if ($user->email_verified_at)
                                            Verified
                                        @else
                                            Not Yet Verified
                                        @endif
                                    </td>
                                    <td>
                                        @can('delete-user')
                                            <button type="submit" class="btn btn-sm btn-danger deletebtn">Delete</button>
                                        @endcan

                                        @can('edit-user')
                                            <a href="{{ route('edit-user', $user->id) }}"class="btn btn-sm btn-info">Edit</a>
                                        @endcan

                                        @if ($user->isStaff())
                                            @can('staff-user-permissions')
                                                <a href="{{ route('users-permissions', $user->id) }}"class="btn btn-sm btn-info">Access</a>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endcomponent

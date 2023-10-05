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
                                    url: "/admin/delete-role/" + delete_id,
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
                    <h4 class="card-title">Roles</h4>
                    <div>
                        <a class="nav-link btn btn-success" href="{{ route('create-role') }}">Create Role</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> role name </th>
                                <th> role lable </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <input type="hidden" class="delete_val_id" value="{{ $role->id }}">
                                    <td> {{ $role->id }} </td>
                                    <td> {{ $role->name }} </td>
                                    <td> {{ $role->lable }} </td>
                                    <td>
                                        <a href="{{ route('edit-role', $role->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger deletebtn">Delete</button>
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

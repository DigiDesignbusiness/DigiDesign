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
                                    url: "/admin/delete-permission/" + delete_id,
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
                    <h4 class="card-title">Permissions</h4>
                    <div>
                        @can('create-premissions')
                        <a class="nav-link btn btn-success" href="{{ route('create-permission') }}">Create permission</a>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> permission name </th>
                                <th> permission lable </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <input type="hidden" class="delete_val_id" value="{{ $permission->id }}">
                                    <td> {{ $permission->id }} </td>
                                    <td> {{ $permission->name }} </td>
                                    <td> {{ $permission->lable }} </td>
                                    <td>
                                        @can('edit-permission')
                                        <a href="{{ route('edit-permission', $permission->id) }}"
                                            class="btn btn-sm btn-info">Edit</a>
                                        @endcan
                                        @can('delete-permission')
                                        <button type="submit" class="btn btn-sm btn-danger deletebtn">Delete</button>
                                        @endcan
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

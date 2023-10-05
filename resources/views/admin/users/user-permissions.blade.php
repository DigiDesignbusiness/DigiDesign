@component('admin.layouts.content')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#roles').select2({
      'placeholer' : 'please select roles'
    });

    $('#permissions').select2({
      'placeholer' : 'please select permissions'
    });
});
</script>
@endsection

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @include('admin.layouts.error')
        <h4 class="card-title">User Permission And Role List</h4>
        <form id="frm" class="form-inline" method="post" action="{{ route('users-permissions-store', $user->id) }}">
            @csrf

          <label class="sr-only" for="inlineFormInputName2">Role List</label>
          <select name="roles[]" id="roles" class="form-control" style="background-color:white !important; color:black !important;" multiple>
            @foreach ($roles as $role)
              <option
                value="{{ $role->id }}" 
                {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $role->name }}
              </option>
            @endforeach
          </select>

          <label class="sr-only" for="inlineFormInputName2">Permission List</label>
          <select name="permissions[]" id="permissions" class="form-control" style="background-color:white !important; color:black !important;" multiple>
            @foreach ($permissions as $permission)
              <option
                value="{{ $permission->id }}" 
                {{ in_array($permission->id, $user->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $permission->name }}
              </option>
            @endforeach
          </select>

          <br>
          <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endcomponent
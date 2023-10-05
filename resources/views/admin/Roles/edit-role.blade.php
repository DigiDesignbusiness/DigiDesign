@component('admin.layouts.content')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
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
        <h4 class="card-title">Edit Role</h4>
        <form id="frm" class="form-inline" method="post" action="{{ route('update-role', $roles->id) }}">
            @csrf
            @method('PUT')
          <input type="text" class="form-control mb-2 mr-sm-2" name="name" placeholder="Enter role's Name" 
          value="{{ old('name', $roles->name) }}" 
          style="background-color:white !important; color:black !important;">
          
          <input type="text" class="form-control mb-2 mr-sm-2" name="lable" placeholder="Enter role's lable" 
          value="{{ old('lable', $roles->lable) }}" 
          style="background-color:white !important; color:black !important;">

          <label class="sr-only" for="inlineFormInputName2">Role's Lable</label>
          <select name="permissions[]" id="permissions" class="form-control" style="background-color:white !important; color:black !important;" multiple>
            @foreach ($permissions as $permission)
              <option
                value="{{ $permission->id }}" 
                {{ in_array($permission->id, $roles->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>
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
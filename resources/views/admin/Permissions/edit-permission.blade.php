@component('admin.layouts.content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @include('admin.layouts.error')
        <h4 class="card-title">Edit Permission</h4>
        <form id="frm" class="form-inline" method="post" action="{{ route('update-permission', $permission->id) }}">
            @csrf
            @method('PUT')
          <input type="text" class="form-control mb-2 mr-sm-2" name="name" placeholder="Enter Permission's Name" 
          value="{{ old('name', $permission->name) }}" 
          style="background-color:white !important; color:black !important;">
          
          <input type="text" class="form-control mb-2 mr-sm-2" name="lable" placeholder="Enter Permission's lable" 
          value="{{ old('lable', $permission->lable) }}" 
          style="background-color:white !important; color:black !important;">
          <br>
          <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endcomponent
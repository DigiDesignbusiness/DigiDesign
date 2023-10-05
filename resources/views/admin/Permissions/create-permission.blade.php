@component('admin.layouts.content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @include('admin.layouts.error')
        <h4 class="card-title">Create Permissions</h4>
        <form id="frm" class="form-inline" method="post" action="{{ route('store-permission') }}">
            @csrf
            <label class="sr-only" for="inlineFormInputName2">Permission's Name</label>
          <input type="text" class="form-control mb-2 mr-sm-2" name="name" placeholder="Enter permission's Name" 
          style="background-color:white !important; color:black !important;">

          <label class="sr-only" for="inlineFormInputName2">Permission's Lable</label>
          <input type="text" class="form-control mb-2 mr-sm-2" name="lable" placeholder="Enter permission's lable" 
          style="background-color:white !important; color:black !important;">
          <br>
          <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endcomponent
@component('admin.layouts.content')

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
  $('#frm').validate({
    rules: {
      categoryName: "required"
    },
    messages: {
      categoryName: "please enter category name"
    }
  });
</script>
@endsection

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        {{-- @include('admin.layouts.error') --}}
        <h4 class="card-title">Edit Category</h4>
        <form id="frm" class="form-inline" method="post" action="{{ route('update-category', $category->id) }}">
            @csrf
            @method('PUT')
          <input type="text" class="form-control mb-2 mr-sm-2" name="categoryName" placeholder="Enter Category Name" 
          value="{{ old('categoryName', $category->categoryName) }}" 
          style="background-color:white !important; color:black !important;"><br>
          <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endcomponent
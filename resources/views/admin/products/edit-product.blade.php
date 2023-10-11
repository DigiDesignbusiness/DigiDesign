@component('admin.layouts.content')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        @include('admin.layouts.error')
        <h4 class="card-title">Edit Product</h4>
        <form class="form-inline" method="post" action="{{ route('update-product', $product->id) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
        <label class="sr-only" for="inlineFormInputName2">Title</label>
        <input type="text" class="form-control mb-2 mr-sm-2" name="title" placeholder="Enter Product's Title" 
        style="background-color:white !important; color:black !important;" value="{{ old('title', $product->title) }}">

        <label for="description">Description</label>
        <textarea class="form-control" name="description" cols="30" rows="5" placeholder="Enter Description"
        style="background-color:white !important; color:black !important;">{{ old('description', $product->desription) }}</textarea>

        <label class="sr-only" for="inlineFormInputName2">Quantity</label>
        <input type="number" class="form-control mb-2 mr-sm-2" name="quantity" placeholder="Enter Product's Quantity" 
        style="background-color:white !important; color:black !important;" value="{{ old('quantity', $product->quantity) }}">

        <label class="sr-only" for="inlineFormInputName2">Price</label>
        <input type="number" class="form-control mb-2 mr-sm-2" name="price" placeholder="Enter The Price" 
        style="background-color:white !important; color:black !important;" value="{{ old('price', $product->price) }}">

        <label class="sr-only" for="inlineFormInputName2">Discount</label>
        <input type="number" class="form-control mb-2 mr-sm-2" name="discount" placeholder="Enter Discount" 
        style="background-color:white !important; color:black !important;" value="{{ old('discount', $product->discount) }}">

        <label class="sr-only" for="inlineFormInputName2">Product Categories</label>
        <select name="category_id" class="form-control" style="background-color:white !important; color:black !important;">
          <option value="" selected="">Add a Category</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->categoryName }}</option>
          @endforeach
        </select>

        <label class="sr-only" for="inlineFormInputName2">Image</label>
        <input type="file" name="image" class="form-control" style="background-color:white !important; color:black !important;">
        <img src="/productImage/{{ $product->image }}" alt="{{ $product->title }}" height="60px" class="mb-2 mt-2">

        <br>
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
      </form>
      </div>
    </div>
  </div>
@endcomponent
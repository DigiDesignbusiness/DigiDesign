@component('admin.layouts.content')

{{-- @section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
  $('#frm').validate({
    rules: {
      name: "required",
      email: "required",
      password: {
        minlength: 8,
      },
      password_confirmation: {
        minlength: 8,
        equalto: #password'
      }
    }
  });
</script>
@endsection --}}

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.error')
                <h4 class="card-title">Create User</h4>
                <form id="frm" class="form-inline" method="post" action="{{ route('store-user') }}">
                    @csrf
                    <label class="sr-only" for="name">User Name</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="name" name="name" placeholder="Enter User's Name"
                        style="background-color:white !important; color:black !important;">

                        <label class="sr-only" for="email">User Email</label>
                    <input type="email" class="form-control mb-2 mr-sm-2" id="email" name="email" placeholder="Enter User's Email"
                        style="background-color:white !important; color:black !important;">

                        <label class="sr-only" for="phone">Phone No</label>
                    <input type="number" class="form-control mb-2 mr-sm-2" id="phone" name="phone" placeholder="Enter User's Phone Number"
                        style="background-color:white !important; color:black !important;">

                        <label class="sr-only" for="address">Address</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="address" name="address" placeholder="Enter User's Address"
                        style="background-color:white !important; color:black !important;">

                        <label class="sr-only" for="password">Password</label>
                    <input type="password" class="form-control mb-2 mr-sm-2" id="password" name="password" placeholder="Enter User's Password"
                        style="background-color:white !important; color:black !important;">

                        <label class="sr-only" for="password_confirmation">Password Confirmation</label>
                    <input type="password" class="form-control mb-2 mr-sm-2" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation"
                        style="background-color:white !important; color:black !important;"><br>

                        <label class="sr-only" for="verify">User Verfication</label>
                    <input type="checkbox" class="form-check-input" id="verify" name="verify"><br><br>

                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endcomponent

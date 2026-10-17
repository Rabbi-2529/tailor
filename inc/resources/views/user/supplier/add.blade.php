@extends('user.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('add_supplier','active')
@section('content')

<section class="content">
  <div class="container-fluid" id="supplier">
    <div class="row">
      <div class="offset-md-3 col-md-6 pt-4">
          @if ($errors->any())
            <div class="alert alert-danger">
              Fill Up All Field 
            </div>
          @endif
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Supplier</h3>
              </div>
                {{ Form::open(['route' => ['user.supplier.add-supplier'] , 'method' => 'post']) }}
                  <div class="card-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Name <span style="color: red;">*</span></label>
                          <input type="text" name="name" value="{{ old('name') }}" class="form-control"  required placeholder="Enter Name">
                          @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Person <span style="color: red;">*</span></label>
                          <input type="text" name="person" value="{{ old('person') }}" class="form-control" required placeholder="Enter Person">
                          @error('person')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Email </label>
                          <input type="email" name="email" value="{{ old('email') }}" class="form-control"  placeholder="Enter Email">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Mobile <span style="color: red;">*</span></label>
                          <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control" required placeholder="Enter Mobile">
                          @error('mobile')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Phone </label>
                          <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter Phone">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Address <span style="color: red;">*</span></label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control" required placeholder="Enter Address">
                        @error('address')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                            <label for="exampleInputPassword1">Website </label>
                            <input type="text" name="website" value="{{ old('website') }}" class="form-control"  placeholder="Enter Website">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Complain Number </label>
                          <input type="number" name="complain" value="{{ old('complain') }}" class="form-control"  placeholder="Enter Complain Number">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Open Due Balance</label>
                          <input type="number" name="due_bal" value="{{ old('due_bal') }}" class="form-control" placeholder="Enter Due Balance">
                      </div>
                      <div class="form-group">
                          <label for="example">Supplier Status <span style="color: red;">*</span>: </label>
                          <input type="radio" name="status" class="" id="Local" value="1"> <label for="Local">Local</label>
                          <input type="radio" name="status" class="" id="Global" value="2"> <label for="Global">Global</label>
                          @error('address')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                      </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                  </div>
                {{ Form::close() }}
          </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('custom_style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection
@section('custom_script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    $(function () {
      $('.select2').select2()
    })

    @if(session()->has('supplier'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('supplier') }}",
        "success",
      )
    @endif
    // Buttton Submit After Disabled
    $('form').submit(function() {
      $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection

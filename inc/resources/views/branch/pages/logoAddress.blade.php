@extends('branch.layout.master')
@section('logo_address','menu-open')
@section('logo_address_link','active')
@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Address & Logo</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid" id="customer">
      <div class="row">
        <!-- left column -->
        <div class="offset-md-3 col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Address & Logo</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {{ Form::open(['route' => 'branch.logo-address.logo-address-insert', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Address<span style="color: red;">*</span></label>
                    <input type="text" name="address" value="{{ $branch_addres }}" class="form-control"  placeholder="Enter Address" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Image<span style="color: red;">*</span></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="exampleInputFile" required>
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Update</button>
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('custom_script')
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
  @if(session()->has('sucess'))
    Swal.fire(
      "Successfully!",
      "{{ session()->get('sucess') }}",
      "success",
    )
  @endif
  
</script>
@endsection
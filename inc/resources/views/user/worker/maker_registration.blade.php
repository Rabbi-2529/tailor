@extends('user.layout.master')
@section('worker_class','menu-open')
@section('worker_class_link','active')
@section('maker_registration','active')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="offset-md-3 col-md-6 pt-4">
          @if ($errors->any())
            <div class="alert alert-danger">
              Fill Up All Field 
            </div>
          @endif
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Maker Registration</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {{ Form::open(['action' => 'user\WorkerController@MakerRegistrationInsert' , 'method' => 'post' , 'enctype' => 'multipart/form-data']) }}
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Name <span style="color: red;">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Name" required>
                @error('name')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Mobile <span style="color: red;">*</span></label>
                <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" placeholder="Enter Mobile" required>
                @error('mobile')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Email <span style="color: red;">*</span></label>
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email" required>
                  @error('email')
                   <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Password <span style="color: red;">*</span></label>
                  <input type="password" name="pass" value="{{ old('pass') }}" class="form-control"  placeholder="Enter Password" required>
                  @error('pass')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Birth-Date (Y-M-D)<span style="color: red;">*</span></label>
                  <input type="text" id="datepicker" name="birth" value="{{ old('birth') }}" class="form-control"  data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="Enter Birth Date" required>
                  @error('birth')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Address <span style="color: red;">*</span></label>
                  <input type="text" name="address" value="{{ old('address') }}" class="form-control"  placeholder="Enter Address" required>
                  @error('address')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">NID</label>
                  <input type="text" value="{{ old('text') }}" class="form-control" placeholder="Enter NID">
              </div>
              <div class="form-group">
                  <label>Ref. Name</label>
                  <input type="text" name="ref_name" value="{{ old('ref_name') }}" class="form-control"  placeholder="Enter Ref. Name">
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Ref. Mobile</label>
                  <input type="text" name="ref_mobile" value="{{ old('ref_mobile') }}" class="form-control" id="" placeholder="Enter Ref. Mobile">
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Image <span style="color: red;">*</span></label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile" required>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
                @error('image')
                 <div class="alert alert-danger  mt-2">{{ $message }}</div>
                @enderror
              </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
              </div>
            {{ Form::close() }}
          </div>

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('custom_style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('custom_script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $("#datepicker").datepicker({
          autoclose: true,
      });
    })
    // Buttton Submit After Disabled
    $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
    });
    @if(session()->has('maker'))
      Swal.fire(
        "Submited!",
        "{{ session()->get('maker') }}",
        "success"
      )
    @endif
  </script>
@endsection
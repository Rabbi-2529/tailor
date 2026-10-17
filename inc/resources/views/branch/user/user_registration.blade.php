@extends('branch.layout.master')
@section('user_class','menu-open')
@section('user_class_link','active')
@section('user_registration','active')
@section('content')
  <section class="content-header">
    @if (session()->has('err'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ session()->get('err') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
  </section>
  <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
              Fill Up All Field 
            </div>
          @endif 
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">User Registration Form</h3>
          </div>
          <!-- /.card-header -->
          {{ Form::open(['action' => 'Branch\UserController@UserRegistrationInsert' , 'method' => 'post' , 'enctype' => 'multipart/form-data' , 'id' => 'user_create_form']) }}
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">User Name <span style="color: red;">*</span></label>
                    <input type="text" name="user"  class="form-control" value="{{ old('user') }}" id="" placeholder="Enter Company Name" required>
                    @error('user')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email <span style="color: red;">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="" placeholder="Enter email" required>
                    @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Password <span style="color: red;">*</span></label>
                      <input type="password" name="pass" class="form-control" id="" placeholder="Enter Password" required>
                      @error('pass')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Mobile <span style="color: red;">*</span></label>
                      <input type="number" name="mobile" class="form-control" value="{{ old('mobile') }}" id="mobilenum" placeholder="Enter Mobile" required>
                      <p class="text-danger" id="mobile_error_message" style="width: 200px; margin: 0px; padding:0px;"></p>
                      <p class="text-success" id="mobile_available_message" style="width: 170px; margin: 0px; padding:0px;"></p>
                      @error('mobile')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">City <span style="color: red;">*</span></label>
                    <input type="text" name="city" class="form-control" value="{{ old('city') }}" id="" placeholder="Enter City" required>
                    @error('city')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address <span style="color: red;">*</span></label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" id="" placeholder="Enter Address" required>
                    @error('address')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Zip Code</label>
                    <input type="number" name="zip" class="form-control" value="{{ old('zip') }}" id="" placeholder="Enter Zip Code">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Ref. Name</label>
                  <input type="number" name="ref_name" class="form-control" value="{{ old('ref_name') }}" id="" placeholder="Enter Ref. Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Ref. Mobile</label>
                  <input type="number" name="ref_mobile" class="form-control" value="{{ old('ref_mobile') }}" id="" placeholder="Enter Ref Mobile">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Status <span style="color: red;">*</span></label>
                   <select name="status" class="form-control select2" required>
                     <option value="">Select One</option>
                     <option value="1">Active</option>
                     <option value="0">Inactive</option>
                   </select>
                   @error('address')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">User Pic </label>
                  <input type="file" name="logo" class="form-control" id="" placeholder="Enter email">
                </div>
                <div class="form-group" style="margin-top: 48px;">
                      <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
                
                <!-- /.form-group -->
              </div>
            </div>
          </div>
          {{ Form::close() }}
          <!-- /.card-body -->
          
        </div>
      </div><!-- /.container-fluid -->
  </section>
@endsection

@section('custom_style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<style>
    .form-control::-webkit-inner-spin-button,
    .form-control::-webkit-calendar-picker-indicator {
          display: none;
          -webkit-appearance: none;
    }
    </style>
@endsection
@section('custom_script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
  <script>
      $(function () {
          //Initialize Select2 Elements
          $('.select2').select2();
      })

      function check_mobile_existence() {
          var mobileno = $("#mobilenum").val();
          $.ajax({
            type: "GET",
            url: "{{ route('branch.user.mobile-exist') }}",
            data: { mobile: mobileno},
            success: function (result) {
              console.log(result);
              if (error_mobile == false){

                if(result != "false") {
                  error_mobile = true;
                  $('#mobile_error_message').html("Mobile Number Already Exists");
                  $('#mobile_available_message').html('');
                } else {
                  error_mobile = false;
                  $('#mobile_error_message').html('');
                  $('#mobile_error_message').hide();
                  $('#mobile_available_message').show();
                  $('#mobile_available_message').html('Mobile Number Available');
                  
                }
              }
            }
      });
    }

        function mobilenumerror(){
          var mobile_num_length = $("#mobilenum").val().length;
          if( mobile_num_length<11 || mobile_num_length>11 ){
            /*$("#mobile_error_message_"+sl).html("Invalid Mobile Number");*/
            error_mobile = true;

            $("#mobile_error_message").html("Invalid Mobile Number");
            $("#mobile_error_message").show("Invalid Mobile Number");
            $("#mobile_available_message").html("");
            $("#mobile_available_message").hide("");
          }else{
            error_mobile = false;
            $("#mobile_error_message").html("");
            check_mobile_existence();
          }
        }

        $("#mobilenum").keyup(function(){
          mobilenumerror();
        });

        $(document).ready(function(){
        if ($("#mobilenum").val().length > 0)  {
          mobilenumerror();
        }

   });

   $("#user_create_form").submit(function () {
      if(error_mobile == true) {
        $("#mobilenum").focus();
        return false;
      } else {
        return true;
      }
    });

    $('form').submit(function() {
         $(this).find("button[type='submit']").prop('disabled',true);
    });

    @if(session()->has('user'))
      Swal.fire(
        "Registered",
        "{{ session()->get('user') }}",
        "success",
      )
    @endif
  </script>
@endsection
@extends('branch.layout.master')
@section('user_class','menu-open')
@section('user_class_link','active')
@section('user_list','active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('branch.user.user-list') }}">User List</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
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
            <h3 class="card-title">User Edit Form</h3>
          </div>
          <!-- /.card-header -->
          {{ Form::open(['action' => 'Branch\UserController@UserRegistrationUpdate' , 'method' => 'post' , 'enctype' => 'multipart/form-data' , 'id' => 'user_edit_form']) }}
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">User Name <span style="color: red;">*</span></label>
                    <input type="text" name="user"  class="form-control" value="{{ $user->UserDetailsUser->its_username }}" required>
                    @error('user')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email <span style="color: red;">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ $user->UserDetailsUser->its_email }}" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Password <span style="color: red;">*</span></label>
                      <input type="password" name="pass" class="form-control" value="{{ $user->UserDetailsUser->its_raw_password }}" required>
                      @error('pass')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Mobile <span style="color: red;">*</span></label>
                      <input type="number" name="mobile" class="form-control" value="{{ $user->UserDetailsUser->its_mobile }}" id="mobilenum" required>
                      <p class="text-danger" id="mobile_error_message" style="width: 200px; margin: 0px; padding:0px;"></p>
                      <p class="text-success" id="mobile_available_message" style="width: 170px; margin: 0px; padding:0px;"></p>
                      @error('mobile')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">City <span style="color: red;">*</span></label>
                    <input type="text" name="city" class="form-control" value="{{ $user->its_user_user_city }}" required>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address <span style="color: red;">*</span></label>
                    <input type="text" name="address" class="form-control" value="{{ $user->UserDetailsUser->its_address }}" required>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Zip Code</label>
                    <input type="number" name="zip" class="form-control" value="{{ $user->its_user_zip_code }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Ref. Name</label>
                  <input type="number" name="ref_name" class="form-control" value="{{ $user->its_user_ref_name }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Ref. Mobile</label>
                  <input type="number" name="ref_mobile" class="form-control" value="{{ $user->its_user_ref_mobile }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select name="status" class="form-control select2" >
                        <option value="">Select One</option>
                        <option value="1">Active</option>
                     <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">User Pic </label>
                  <input type="file" name="logo" class="form-control" id="" placeholder="Enter email">
                </div>
                <div class="form-group" style="margin-top: 48px;">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                    
                <input type="hidden" name="user_login_id" id="user_login_id" class="form-control" value="{{ $user->its_user_login_id }}">
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

      document.forms['user_edit_form'].elements['status'].value  =  {{ $user->its_user_status }}

      $(function () {
          //Initialize Select2 Elements
          $('.select2').select2();
      })

      function check_mobile_existence() {
          let mobileno = $("#mobilenum").val();
          let user_login_id = $("#user_login_id").val();
          $.ajax({
            type: "GET",
            url: "{{ route('branch.user.mobile-exist-edit') }}",
            data: { mobile: mobileno,user_login_id:user_login_id},
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



      @if(session()->has('success'))
        Swal.fire(
          "Successfuly",
          "{{ session()->get('success') }}",
          "success",
        )
      @endif
    </script>
@endsection
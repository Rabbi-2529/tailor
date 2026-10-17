@extends('admin.layout.master')
@section('com_reg_class','menu-open')
@section('com_reg_link','active')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Company Registration</h1>
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
          <h3 class="card-title">Company Registration Form</h3>
        </div>
        <!-- /.card-header -->
        {{ Form::open(['action' => 'Admin\CompanyController@CompanyRegistration' , 'method' => 'post' , 'id' => 'company_create_form']) }}
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Name <span style="color: red;">*</span></label>
                    <input type="text" name="company" value="{{ old('company') }}" class="form-control" id="" placeholder="Enter Company Name">
                    @error('company')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email <span style="color: red;">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="" placeholder="Enter email">
                    @error('email')
                       <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Password <span style="color: red;">*</span></label>
                      <input type="password" name="pass" class="form-control" id="" placeholder="Enter Password">
                      @error('pass')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Mobile <span style="color: red;">*</span></label>
                      <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control" id="mobilenum" placeholder="Enter Mobile">
                      @error('mobile')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                      <p class="text-danger" id="mobile_error_message" style="width: 200px; margin: 0px; padding:0px;"></p>
                      <p class="text-success" id="mobile_available_message" style="width: 170px; margin: 0px; padding:0px;"></p>
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" id="" placeholder="Enter Phone">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Fax No</label>
                    <input type="text" name="fax" value="{{ old('fax') }}" class="form-control" id="" placeholder="Enter Fax-No">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Open Time</label>
                      <input type="text" name="open" value="{{ old('open') }}" class="form-control timepicker" autocomplete="off" id="" placeholder="Enter Open Time">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Close Time</label>
                    <input type="text" name="close" value="{{ old('close') }}" class="form-control timepicker" autocomplete="off" id="" placeholder="Enter Close Time">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Website</label>
                      <input type="text" name="website" value="{{ old('website') }}" class="form-control" id="" placeholder="Enter Website Link">
                      @error('website')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Taxable</label>
                      <select name="tax" id="" class="form-control">
                          <option value="">Select One</option>
                          <option value="1">Yes</option>
                          <option value="2">No</option>
                    </select>
                </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                    <label for="exampleInputEmail1">Select Divison <span style="color: red;">*</span></label>
                    <select class="form-control select2" name="division_id" id="divisionIdCatch" required>
                      <option value="">Select One</option>
                      @foreach ($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option> 
                      @endforeach
                    </select>
                    @error('division_id')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
              </div>            
              <div class="form-group">
                  <label for="exampleInputEmail1">Select District <span style="color: red;">*</span></label>
                  <select class="form-control select2" name="district_id" id="district" required>
                    
                  </select>
                  @error('district_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Select Upzila <span style="color: red;">*</span></label>
                  <select class="form-control select2" name="upzila_id" id="upzila" required>
                    
                  </select>
                  @error('upzila_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                      <label for="exampleInputEmail1">Address <span style="color: red;">*</span></label>
                      <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="" placeholder="Enter Address">
                      @error('address')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
              </div>
              <div class="form-group">
                    <label for="exampleInputEmail1">Zip Code</label>
                    <input type="number" name="zip" value="{{ old('zip') }}" class="form-control" id="" placeholder="Enter Zip Code">
              </div>  
             
              <div class="form-group">
                    <label for="exampleInputEmail1">Business Type</label>
                    <input type="text" name="b_type" value="{{ old('b_type') }}" class="form-control" id="" placeholder="Enter Business Type">
              </div>
             
              <div class="form-group">
                    <label for="exampleInputEmail1">Company Type</label>
                    <input type="text" name="c_type" value="{{ old('c_type') }}" class="form-control" id="" placeholder="Enter Company Type">
              </div>
              <div class="form-group">
                    <label for="exampleInputEmail1">Company Sender ID</label>
                    <input type="text" name="sender_id" value="{{ old('sender_id') }}" class="form-control" id="" placeholder="Enter Company Sender ID">
              </div>
              <div class="form-group">
                    <label for="exampleInputEmail1">Company API Key</label>
                    <input type="text" name="api_key" value="{{ old('api_key') }}" class="form-control" id="" placeholder="Enter Company API Key">
              </div>
              <div class="form-group">
                    <label for="exampleInputEmail1">Expire Date (Y-M-D)<span style="color: red;">*</span></label>
                    <input type="text" name="expire" value="{{ old('expire') }}" class="form-control datepicker" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Enter Expire Date">
                    @error('expire')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
              </div>
              <div class="form-group text-right" style="margin-top: 48px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>

      $(function () {
          $(".datepicker").datepicker({
            autoclose: true,
          });
          //Initialize Select2 Elements
          $('.select2').select2();
          // Time Picker
          $('input.timepicker').timepicker({});
      })

      $(document).on('change','#divisionIdCatch',function(){
          let division_id = $(this).val();

        $.ajax({
            type: "get",
            url: "{{ route('admin.district-name-show') }}",
            data: { division_id: division_id},
            success: function (result) {
                $('#district').html(result);
            }
        });
      });

      $(document).on('change','#district',function(){
          let district_id = $(this).val();

        $.ajax({
            type: "get",
            url: "{{ route('admin.upazila-name-show') }}",
            data: { district_id: district_id},
            success: function (result) {
                $('#upzila').html(result);
            }
        });
      });

    function check_mobile_existence() {
        var mobileno = $("#mobilenum").val();

          $.ajax({
            type: "GET",
            url: "{{ route('admin.mobile-number-exist') }}",
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

   $("#company_create_form").submit(function () {
      if(error_mobile == true) {
        $("#mobilenum").focus();
        return false;
      } else {
        return true;
      }
    });
      
    @if(session()->has('company'))
        Swal.fire(
            "Submited!",
            "{{ session()->get('company') }}",
            "success"
        )
    @endif
     // Input Type Number Arrow Keyup Not Work Script
    $(document).ready(function() {
      $("input[type=number]").on("focus", function() {
          $(this).on("keydown", function(event) {
              if (event.keyCode === 38 || event.keyCode === 40) {
                  event.preventDefault();
              }
          });
        });
    })
    // disable mousewheel on a input number field when in focus
    $('form').on('focus', 'input[type=number]', function (e) {
      $(this).on('wheel.disableScroll', function (e) {
        e.preventDefault()
      })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
      $(this).off('wheel.disableScroll')
    })
    // Buttton Submit After Disabled
    $('form').submit(function() {
       $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection

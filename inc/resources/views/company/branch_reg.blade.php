@extends('company.layout.master')
@section('branch_reg','menu-open')
@section('branch_reg_link','active')
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

  @if (session()->has('branch'))
  <div class="alert alert-success alert-dismissible" role="alert">
      {{ session()->get('branch') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Branch Registration</h1>
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
          <h3 class="card-title">Branch Registration Form</h3>
        </div>
        <!-- /.card-header -->
        {{ Form::open(['action' => 'company\BranchController@BranchRegistrationInsert' , 'method' => 'post' , 'enctype' => 'multipart/form-data' , 'id' => 'branch_create_form']) }}
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Branch Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="" placeholder="Enter Branch Name">
                    @error('name')
                       <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Person Name <span style="color: red;">*</span></label>
                    <input type="text" name="person" value="{{ old('person') }}" class="form-control" id="" placeholder="Enter Person Name">
                    @error('person')
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
              <!-- /.form-group -->
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
                    <input type="text" name="fax" value="{{ old('fax') }}" class="form-control" id="" placeholder="Enter Fax No">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Open Time</label>
                      <input type="text" name="open" value="{{ old('open') }}" class="form-control timepicker" autocomplete="off" id="" placeholder="Enter Open Time">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Close Time</label>
                      <input type="timepicker" name="close" value="{{ old('close') }}" class="form-control timepicker" autocomplete="off" id="" placeholder="Enter Close Time">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Website</label>
                      <input type="text" name="website" value="{{ old('website') }}" class="form-control" placeholder="Enter Website Link">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Message Service</label><br>
                      <input type="checkbox" name="message[]"  value="1"> Create Order<br>
                      <input type="checkbox" name="message[]"  value="2"> Complete Order <br>
                      <input type="checkbox" name="message[]"  value="3"> Delivery Order <br>
                      <input type="checkbox" name="message[]"  value="4"> Payment Pay
                </div>
            </div>
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
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Enter Address">
                    @error('address')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Zip Code</label>
                    <input type="text" name="zip" value="{{ old('zip') }}" class="form-control" placeholder="Enter Zip Code">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Business Type</label>
                      <input type="text" name="b_type" value="{{ old('b_type') }}" class="form-control" placeholder="Enter Business Type">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Taxable</label>
                      <input type="text" name="tax" value="{{ old('tax') }}" class="form-control" placeholder="Enter Tax">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Branch Sender ID</label>
                      <input type="text" name="senderId" value="{{ old('senderId') }}" class="form-control" placeholder="Enter Sender ID">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Branch API Key</label>
                    <input type="text" name="api_key" value="{{ old('api_key') }}" class="form-control" id="" placeholder="Enter  API Key">
               </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Order No.</label>
                      <input type="text" name="order" value="{{ old('order') }}" class="form-control" placeholder="Enter Order No">
                </div>
                <div class="form-group text-right" style="margin-top: 48px;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
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
<link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
<style>
.form-control::-webkit-inner-spin-button,
.form-control::-webkit-calendar-picker-indicator {
    display: none;
    -webkit-appearance: none;
}
</style>
@endsection
@section('custom_script')
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
    $( function() {
        $('#expire').datepicker({
              autoclose: true,
              todayHighlight: true
        });
        //Initialize Select2 Elements
        $('.select2').select2();
        // Time Picker
        $('input.timepicker').timepicker({});
    });

    $(document).on('change','#divisionIdCatch',function(){
          let division_id = $(this).val();

        $.ajax({
            type: "get",
            url: "{{ route('company.district-name-show') }}",
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
            url: "{{ route('company.upazila-name-show') }}",
            data: { district_id: district_id},
            success: function (result) {
                $('#upzila').html(result);
            }
        });
    });

    function check_mobile_existence() {
      let mobileno = $("#mobilenum").val();

      $.ajax({
        type: "GET",
        url: "{{ route('company.mobile-number-exist') }}",
        data: { mobile: mobileno},
        success: function (result) {
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
      let mobile_num_length = $("#mobilenum").val().length;
      
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

   $("#branch_create_form").submit(function () {
      if(error_mobile == true) {
        $("#mobilenum").focus();
        return false;
      } else {
        return true;
      }
  });

  @if(session()->has('branch'))
    Swal.fire(
      "Registered",
      "{{ session()->get('branch') }}"
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

  
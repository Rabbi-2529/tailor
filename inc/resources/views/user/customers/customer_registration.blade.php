@extends('user.layout.master')
@section('customer_class','menu-open')
@section('customer_class_link','active')
@section('customer_registration','active')
@section('content')

      <section class="content">
        <div class="container-fluid" id="customer">
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
                  <h3 class="card-title">Customer Registration</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{ Form::open(['action' => 'user\CustomerController@CustomerRegistrationInsert' , 'method' => 'post' , 'enctype' => 'multipart/form-data']) }}
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputPassword1">Customer's Mobile/গ্রাহকের মোবাইল <span style="color: red;">*</span></label>
                      <input type="number" name="mobile" autocomplete="off"  class="form-control" value="{{ old('mobile') }}" id="mobilenum" placeholder="Enter Mobile" required>
                      @error('mobile')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                      <p class="text-danger" id="mobile_error_message" style="width: 200px; margin: 0px; padding:0px;"></p>
                      <p class="text-success" id="mobile_available_message" style="width: 170px; margin: 0px; padding:0px;"></p>
                  </div>
                  <div class="mb-2 text-right d-none">
                    <button type="button" id="add_company_customer" class="btn btn-sm btn-success">Add Information</button>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Customer's Name/গ্রাহকের নাম <span style="color: red;">*</span></label>
                    <input type="text" name="name" class="form-control"  value="{{ old('name') }}" id="" placeholder="Enter Name" required>
                    @error('name')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Customer's Email/গ্রাহকের ইমেইল</label>
                    <input type="email" name="email" class="form-control"  value="{{ old('email') }}" id="" placeholder="Enter Email">
                    @error('email')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Customer's NID/গ্রাহকের জাতীয় পরিচয় পত্র নং</label>
                      <input type="number" name="nid" class="form-control" value="{{ old('nid') }}" id="" placeholder="Enter NID">
                  </div>
                  <div class="form-group">
                      <label>Customer's Blood Group/গ্রাহকের রক্তের গ্রুপ</label>
                      <select class="form-control select2" name="blood_group">
                          <option value="">Select One</option>
                          <option v-for="bld in blood" :value="bld.its_blood_slno">
                            @{{ bld.its_blood_group }}
                          </option>
                      </select>
                      @error('blood_group')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Customer's Birth Date (Y-M-d)/গ্রাহকের জন্ম দিন</label>
                      <input type="text" id="datepicker" name="birth" autocomplete="off" class="form-control" value="{{ old('birth') }}" id="from" data-date-format="yyyy-mm-dd" placeholder="Enter Birth Date">
                      @error('birth')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Customer's Address/গ্রাহকের ঠিকানা <span style="color: red;">*</span></label>
                      <input type="text" name="address" class="form-control" value="{{ old('address') }}" id="" placeholder="Enter Address" required>
                      @error('address')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label>Customer's Referrence/গ্রাহকের রেফারেন্স</label>
                      <select class="form-control select2" name="referrence">
                          <option value="">Select One</option>
                          <option v-for="ref in refer" :value="ref.its_cus_name">
                            @{{ ref.its_cus_name }}
                          </option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Customer's Image/গ্রাহকের ছবি</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
  <link rel="stylesheet" href="/resources/demos/style.css">
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
  <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    
        //Initialize Datepicker
        $("#datepicker").datepicker({
            autoclose: true,
        });
    
      })
</script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
  var customer = new Vue({
    el: '#customer',
    data:{
      blood: {!! json_encode($bloods) !!},
      refer: {!! json_encode($cus_ref) !!}
    }
  });
</script>
<script>

    $( function() {
      $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
      });
    });
    $(document).on('click','#add_company_customer',function(e){
        e.preventDefault();

        let mobileno = $("#mobilenum").val();

        if(mobileno == ""){
            alert('Enter Customer Number')
            return false;
        }

        $.ajax({
          type: "get",
          url: "{{ route('user.customer.customer-insert-from-company') }}",
          data: { mobile: mobileno},
          success: function (result) {
            if(result == 'customer_insert') {
                Swal.fire(
                  "Successfully",
                  "Customer Information Insert",
                  "success"
                )
            }
            else{
                Swal.fire(
                  "Already",
                  "Customer Information Insert",
                  "error"
                )
            }
          }
      });
    });
    function check_mobile_existence()
    {
      var mobileno = $("#mobilenum").val();

      $.ajax({
          type: "get",
          url: "{{ route('user.customer.customer-mobile-number-exist') }}",
          data: { mobile: mobileno},
          success: function (result) {
            if (error_mobile == false){

              if(result != "false") {
                error_mobile = true;
                $('#mobile_error_message').html("Mobile Number Already Exists");
                $('#mobile_available_message').html('');
                $('.d-none').addClass('d-block')
              } else {
                error_mobile = false;
                $('#mobile_error_message').html('');
                $('#mobile_error_message').hide();
                $('#mobile_available_message').show();
                $('#mobile_available_message').html('Mobile Number Available');
                $('.d-none').removeClass('d-block')
                
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

   $("#customer_create_form").submit(function () {
      if(error_mobile == true) {
        $("#mobilenum").focus();
        return false;
      } else {
        return true;
      }
    });
    // Buttton Submit After Disabled
    $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
    });
    @if(session()->has('customer'))
      Swal.fire(
        "Registered",
        "{{ session()->get('customer') }}",
        "success"
      )
    @endif
</script>
@endsection
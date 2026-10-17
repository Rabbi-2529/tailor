@extends('user.layout.master')
@section('customer_class','menu-open')
@section('customer_class_link','active')
@section('payments','active')
@section('content')
  <section class="content pt-3">
    <div class="container-fluid" id="payments">
      <div class="row">
        <!-- left column -->
        <div class="offset-md-3 col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Customer Payments</h3>
            </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('user.customer.customer-payment') }}" method="POST" id="customer_payment">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="cus_name" class="col-sm-3 col-form-label">Customer Name</label>
                    <div class="col-sm-9">
                      <select id="customer_id" name="customer_id"  class="form-control select2" required>
                        <option value="">Select One</option>
                          @foreach ($customers as $cus)
                            @php
                                $brandIds = explode(',',$cus->its_cus_bran_id);
                            @endphp
                            @if(in_array($bran,$brandIds))
                                <option value="{{ $cus->its_cus_slno }}">{{ $cus->its_cus_name }} ({{ $cus->its_cus_mobile }})</option> 
                            @endif
                          @endforeach
                      </select>
                      @error('customer_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="row pb-2">
                    <div class="col-sm-3  payable" style="display: none;">
                        <label for="payment" class="pt-0 col-form-label">Payable Amount</label>
                    </div>
                    <div class="col-sm-9 payable" style="display: none;">
                      <input type="text" id="payable_amount" class="form-control" name="previus_due" readonly>
                    </div>
                  </div>
                  <div class="form-group row ">
                    <label for="payment" class="col-sm-3 col-form-label">Payment</label>
                    <div class="col-6 col-sm-3">
                      <input type="number" name="amount" class="form-control text-right" autocomplete="off" v-model="amount" placeholder="Amount" min="1" required>
                    </div>
                    <div class="col-6 col-sm-3">
                      <input type="number" name="discount" class="form-control text-right" autocomplete="off" v-model="discount" placeholder="Discount" min="1">
                    </div>
                    <div class="col-12 col-sm-3 pt-2 pt-sm-0">
                      <input type="number" name="total_amount" class="form-control text-right" :value="total_payment" placeholder="Total Amount" readonly>
                    </div>
                    <div class="offset-sm-3 col-sm-9 col-12">
                      @error('amount')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bank" class="col-sm-3 col-form-label">Bank</label>
                    <div class="col-sm-9">
                      <select  name="bank_id" class="form-control select2" onchange="bank_name(this.value)" required>
                        <option value="">Select One</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank->its_bank_acc_bank_name }}">{{ $bank->bankName->its_bank_name }}</option>
                        @endforeach
                      </select>
                      @error('bank_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bank" class="col-sm-3 col-form-label">Account No <span style="color: red;">*</span></label>
                    <div class="col-sm-9">
                       <input type="text" readonly name="acc_no" id="acc_no" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pay_date" class="col-sm-3 col-form-label">Payment Date</label>
                    <div class="col-sm-9">
                      <input type="text" name="payment_date" class="form-control" value="{{ $currnet_date }}" id="datepicker" autocomplete="off" data-date-format="yyyy-mm-dd"  placeholder="Payment Date" required>
                      @error('payment_date')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="decription" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                      <input type="text" autocomplete="off" name="description" class="form-control" placeholder="Description" required>
                      @error('description')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button id="button-disabled" type="submit"  class="btn btn-info float-right">Payment</button>
                </div>
                <!-- /.card-footer -->
              </form>
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
       var app = new Vue({
        el: '#payments',
          data: {
            amount: '',
            discount: '',
            total: [],
          },
          computed: {
            total_payment: function(){
              if(this.amount != "" && this.discount != "" )
              {
                let total = parseFloat(this.amount) - parseFloat(this.discount);
                return total;
              }
              return this.amount;
            }
          }
      });

      $(function () {
          $('.select2').select2()
           //Initialize Datepicker
          $("#datepicker").datepicker({
              autoclose: true,
          });

      })
      function bank_name(bank_id) {
          let url = "{{ route('user.bank.bank-acc-no-ajax') }}";
          var _token=$("#_token").val();
          
          $.ajax({  
              type: "GET",
              url: url,
              data: { bank_id: bank_id,_token:_token},
              success: function (result) {
                $("#acc_no").val(result);
              }
          });
      }
      $(document).on('change','#customer_id',function(){
          let customer_id = $(this).val();
          
          $.ajax({
              url: "{{ route('user.customer.customer-payable-amount') }}",
              type: 'get',
              data: {customer_id:customer_id},
              success: function(result){
                 $('.payable').addClass('d-block');
                 $('#payable_amount').val(result +'.'+'00');
              },
          }); 
      });

    @if(session()->has('payment_success'))
        Swal.fire(
            "Successfully!",
            "{{ session()->get('payment_success') }}",
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
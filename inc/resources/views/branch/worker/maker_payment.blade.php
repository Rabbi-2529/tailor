@extends('branch.layout.master')
@section('worker_class','menu-open')
@section('worker_class_link','active')
@section('maker_payment','active')
@section('content')
  <section class="content">
    <div class="container-fluid" id="make_payments">
      <div class="row">
        <!-- left column -->
        <div class="offset-md-3 col-md-6 pt-4">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Maker Payments</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ route('branch.worker.maker-payment-insert') }}" method="" id="maker_payment_form">
              <div class="card-body">
                <div class="form-group row">
                    <label for="bank" class="col-sm-3 col-form-label">Bank <span style="color: red;">*</span></label>
                    <div class="col-sm-9">
                      <select  id="from_bank_id" name="bank_id" class="form-control select2" onchange="bank_name(this.value)" required>
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
                  <label for="bank" class="col-sm-3 col-form-label">Account No </label>
                  <div class="col-sm-9">
                    <input type="text" readonly name="acc_no" id="acc_no" class="form-control">
                  </div>
                </div>
                <div class="form-group row" id="amount" style="display: none;">
                  <div class="col-sm-12">
                    <label for="bank_amount" class="col-sm-3 col-form-label pl-0 float-left">Bank Amount</label>
                    <input type="text" id="bank_amount" name="bank_amount"  class="form-control  col-sm-9" readonly>
                    <div class="text-danger offset-sm-3" id="insufficient"></div> 
                  </div>
                </div>
                <div class="form-group row">
                  <label for="cus_name" class="col-sm-3 col-form-label">Name<span style="color: red;">*</span></label>
                  <div class="col-sm-9">
                    <select class="form-control select2" id="maker_credit_maker_id"  name="maker_credit_maker_id" required> 
                      <option value="">Select One</option>
                      <option v-for="mkr in maker" :value="mkr.its_maker_credit_maker_id">
                        @{{ mkr.maker_name.its_maker_name }}
                      </option>
                    </select>
                    @error('maker_credit_maker_id')
                      <div class="alert alert-danger mt-2 mb-0">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row" id="payable" style="display: none;">
                  <div class="col-sm-12">
                    <label for="payable_amount" class="col-sm-3 col-form-label pl-0 float-left">Payable</label>
                    <input type="text" name="payable_amount" class="form-control col-sm-9" id="payable_amount" placeholder="Payable Amount" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="payment" class="col-sm-3 col-form-label">Payment<span style="color: red;">*</span></label>
                   <div class="col-sm-9 col-12 row  pr-0">
                       <div class="col-6 col-sm-4">
                          <input type="number" name="payment_amount"  onkeyup="check_amount(this.value)"  class="form-control check_amount_empty text-right" autocomplete="off"  v-model="amount" placeholder="Amount" min="1" required>
                        </div>
                        <div class="col-6 col-sm-4">
                          <input type="number" autocomplete="off" name="bonus_amount" class="form-control text-right" v-model="bonus" placeholder="Bonus" min="1">
                        </div>
                        <div class="col-12 col-sm-4 pt-2 pt-sm-0 pr-sm-0">
                          <input type="text" class="form-control text-right check_amount_empty" :value="total_payment" placeholder="Total Amount" readonly>
                        </div>
                        @error('payment_amount')
                          <div class="alert alert-danger col-12 ml-1 mt-2 mb-0">{{ $message }}</div>
                        @enderror
                        <div class="text-danger ml-1" id="pay_insufficient"></div> 
                   </div>
                </div>
                <div class="form-group row">
                  <label for="pay_date" class="col-sm-3 col-form-label">Pay. Date <span style="color: red;">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="payment_date" value="{{ $current_date }}" data-date-end-date="{{ $current_date }}" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control"  id="datepicker" placeholder="Payment Date" required>
                    @error('payment_date')
                      <div class="alert alert-danger mt-2 mb-0">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="decription" class="col-sm-3 col-form-label">Desc. <span style="color: red;">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" autocomplete="off" name="description" class="form-control"  placeholder="Description" required>
                    @error('description')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" id="submit_payment" class="btn btn-info float-right">Payment</button>
                </div>
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
      el: '#make_payments',
      data: {
        maker: {!! json_encode($maker_payments) !!},
        amount: '',
        bonus: '',
        total: [],
      },
      computed: {
        total_payment: function(){
          
          if(this.amount != "" && this.bonus)
          {
            let total = parseFloat(this.amount) + parseFloat(this.bonus);
            return total;
          }
          return this.amount;
        }
      }
    });

    //Initialize Select2 Elements
    $(function () {
      $('.select2').select2()
      //Initialize Datepicker
      $("#datepicker").datepicker({
          autoclose: true,
      });
    })
    // Two Function Work One Account No Show And Account Amount Show
    function bank_name(bank_id)
    { 
        // Account No Show Script 
        let url = "{{ route('branch.bank.bank-acc-no-ajax') }}";
        var _token=$("#_token").val();
        
        $.ajax({  
            type: "GET",
            url: url,
            data: { bank_id: bank_id,_token:_token},
            success: function (result) {
              $("#acc_no").val(result);
            }
        });

        // Account Amount Show Script
        let bank_amount_url = "{{ route('branch.bank.bank-amount') }}";
        let amount = document.getElementById("amount");
        let input_amount = $(".check_amount_empty").val();

        $.ajax({  
            type: "GET",
            url: bank_amount_url,
            data: { bank_id: bank_id,_token:_token},
            success: function (result) {
                amount.style.display = "block";
                $('#bank_amount').val(result +'.'+'00');

                if(result <= 0){
                    $('#insufficient').html('Insufficient balance')
                    $('.float-right').prop('disabled', true);
                }
                else{
                    $('.float-right').prop('disabled', false);
                    $('#insufficient').html('');
                }
            }
        });
    }
   // Maker Payment Amount Show Script
   $(document).on('change','#maker_credit_maker_id',function()
   {
        let maker_credit_maker_id = $(this).val(); 
        let payable = document.getElementById("payable");
        let from_bank_id = $('#from_bank_id').val();
        

        if(from_bank_id == ""){
            $('#maker_credit_maker_id').val("");
            alert('Select Bank Name');
            $('.float-right').prop('disabled', true);
            return false;
        }

        $.ajax({
          url: '{{ route('branch.worker.maker-payable-amount') }}',
          type: 'get',
          data: {maker_credit_maker_id:maker_credit_maker_id},
          success: function(result){
              payable.style.display = "block";
              $('#payable_amount').val(result +'.'+'00');

              if(result == 0){
                  $('#submit_payment').prop("disabled",true);
              }
              else{
                  $('#submit_payment').prop("disabled",false);
              }
          },
        });
   })
  // Check Amount from Database 
  function check_amount(amount)
  {   
      let payable_amount = parseInt($('#payable_amount').val().split('.')[0]);
      let input_amount = parseInt(amount);
      let from_bank_id = $('#from_bank_id').val();

      //  Payable Amount And Input Amount Check
      if(payable_amount < input_amount)
      {
        $('#pay_insufficient').html('Insufficient balance')
        $('.float-right').prop('disabled', true);
        return false;
      }
      else{
          $('#pay_insufficient').html('');
      }
      // Bank Select Check 
      if(from_bank_id == ""){
          alert('Select Bank Name');
          $('.float-right').prop('disabled', true);
          $(".check_amount_empty").val('');
          return false;
      }
      // Maker Select Check 
      if($('#payable_amount').val() == ""){
          alert('Select Maker Name');
          $('.float-right').prop('disabled', true);
          $(".check_amount_empty").val('');
          return false;
      }

      $.ajax({  
        type: "GET",
        url: "{{ route('branch.bank.check-bank-amount') }}",
        data: { amount: amount,from_bank_id:from_bank_id},
        success: function (result) {

            if(result.insufficient == 'insufficient'){
                $('#insufficient').html('Insufficient balance')
                $('.float-right').prop('disabled', true);
            }
            if(result.available == 'available'){
                $('#insufficient').html('')
                $('.float-right').prop('disabled', false);
            }
        }
      });
      
  }
  @if(session()->has('payment_success'))
      Swal.fire(
          "Successfully!",
          "{{ session()->get('payment_success') }}",
          "success"
      )
  @endif
  // Buttton Submit After Disabled
  $('form').submit(function() {
      $(this).find("button[type='submit']").prop('disabled',true);
  });
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
</script>
@endsection
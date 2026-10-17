@extends('branch.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('supplier_payment','active')
@section('content')
  <section class="content">
    <div class="container-fluid" id="supplier">
      <div class="row">
        <div class="offset-md-3 col-md-6 pt-4">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Supplier Payment</h3>
            </div>
            {{ Form::open(['route' => ['branch.supplier.payment-insert'] , 'method' => 'post']) }}
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bank Name <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                          <select class="form-control select2" id="from_bank_id" name="bank_id" onchange="bank_name(this.value)" required>
                              <option value="">Select One</option>
                              @foreach ($banks as $bank)
                                  <option value="{{ $bank->its_bank_acc_bank_name }}">{{ $bank->bankName->its_bank_name }} ({{ $bank->its_bank_acc_branch_name }})</option>
                              @endforeach
                          </select>
                          @error('bank_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                        </div>   
                    </div>
                    <div class="form-group row">
                        <label for="branch_name"  class="col-sm-3 col-form-label">Account No <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" readonly name="acc_no_id" id="acc_no" class="form-control" required>
                          @error('acc_no_id')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label  for="branch_name"  class="col-sm-3 col-form-label amount" style="display: none;">Bank Amount</label>
                        <div class="col-sm-9">
                          <input type="text" id="bank_amount"   class="form-control amount" style="display: none;" readonly>
                          <div class="text-danger" id="insufficient"></div> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user" class="col-sm-3 col-form-label">Supplier <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                          <select name="supplier_id" id="supplier_id" class="form-control select2" required>
                            <option value="">Select One</option>
                            <option v-for="sup in supplier" :value="sup.its_sup_slno">
                              @{{ sup.its_sup_name }}
                            </option>
                          </select>
                          @error('supplier_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="payable_amount" class="col-sm-3 col-form-label payable_amount" style="display: none;">Payable</label>
                      <div class="col-sm-9">
                          <input type="text" name="payable_amount" class="form-control payable_amount" id="payable_amount" style="display: none;" readonly>
                          <div class="text-danger" id="pay_insufficient"></div>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="payment" class="col-sm-3 col-form-label">Payment <span style="color: red;">*</span></label>
                        <div class="col-6 col-sm-3">
                            <input type="number" name="amount" autocomplete="off" id="check_amount_empty" onkeyup="check_amount(this.value)"  class="form-control text-right" required v-model="amount" placeholder="Amount"  min="1">
                        </div>
                        <div class="col-6 col-sm-3">
                            <input type="number" name="discount" autocomplete="off" class="form-control text-right" v-model="discount" placeholder="Discount"  min="1">
                        </div>
                        <div class="col-12 col-sm-3 pt-2 pt-sm-0">
                            <input type="text" name="total_amount" class="form-control text-right" :value="total_amount" placeholder="Total Amount" readonly>
                        </div>
                        <div class="offset-sm-3 col-sm-9 col-12">
                            @error('total_amount')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Payment Date <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" readonly name="payment_date" data-date-format="yyyy-mm-dd" autocomplete="off" value="{{ $current_date }}" class="form-control" id="datepicker" placeholder="Enter Name">
                          @error('payment_date')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="desc" class="form-control"  placeholder="Enter Description">
                          @error('desc')
                              <div class="alert alert-danger mt-2">{{ $message }}</div>
                          @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right ">Payment</button>
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
  <link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('custom_script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    $(function () {
        $('.select2').select2()
        //Initialize Datepicker
        $("#datepicker").datepicker({
            autoclose: true,
        });
    })
    
    var group = new Vue({
      el: '#supplier',
      data:{
        supplier: {!! json_encode($suppliers) !!},
        amount: '',
        discount: '',
        total: [],
      },
      computed: {
        total_amount: function()
        {
            if(this.amount != "" && this.discount != "" )
            {
              let total = parseFloat(this.amount) - parseFloat(this.discount);
              return total;
            }
            return total = this.amount;
        }
      }
    });
    // Two Function Work One Account No Show And Account Amount Show
    function bank_name(bank_id) 
    {
        // Account No Show Script
        let url = "{{ route('branch.bank.bank-acc-no-ajax') }}";
        let _token=$("#_token").val();
        
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

        $.ajax({  
            type: "GET",
            url: bank_amount_url,
            data: { bank_id: bank_id,_token:_token},
            success: function (result) {
                $('.amount').addClass('d-block');
                $('#bank_amount').val(result +'.'+'00');

                if(result <= 0){
                    $('#insufficient').html('Insufficient balance')
                    $('.float-right').prop('disabled', true);
                }
                else{
                    $('.float-right').prop('disabled', false);
                    $('#insufficient').html('')
                }
            }
        });
    }
    // Supplier Payment Amount Show Script
    $(document).on('change','#supplier_id',function()
    {
        let supplier_id = $(this).val(); 
        let from_bank_id = $('#from_bank_id').val();

        if(from_bank_id == ""){
            alert('Select Bank Name');
            $('.float-right').prop('disabled', true);
            return false;
        }

        $.ajax({
            url: "{{ route('branch.supplier.payable-amount') }}",
            type: 'get',
            data: {supplier_id:supplier_id},
            success: function(result){
                $('.payable_amount').addClass('d-block');
                $('#payable_amount').val(result +'.'+'00');
                
                if(result == 0){
                    $('.float-right').prop('disabled', true);
                }
                else{
                    $('.float-right').prop('disabled', false);
                }
            },
        });
    })
    // Check Amount from Database 
    function check_amount(amount)
    {
        let payable_amount = parseInt($('#payable_amount').val().split('.')[0]);
        let input_amount = parseInt(amount);

        //  Payable Amount And Input Amount Check
        if(payable_amount < input_amount)
        {
          $('#pay_insufficient').html('Insufficient balance')
          $('.float-right').prop('disabled', true);
          return false;
        }
        else{
            $('#pay_insufficient').html('')
        }
        // Maker Select Check 
        if($('#payable_amount').val() == ""){
            alert('Slect Supplier Name');
            $('.float-right').prop('disabled', true);
            return false;
        }

        let from_bank_id = $('#from_bank_id').val();

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
    @if(session()->has('success'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('success') }}",
        "success",
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
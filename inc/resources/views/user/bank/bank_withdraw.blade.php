@extends('user.layout.master')
@section('bank_details','menu-open')
@section('bank_details_link','active')
@section('bank_withdraw','active')
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
    <div class="container-fluid" id="bank">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Fill Up All Field 
                    </div>
                @endif
                 <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Bank Withdraw</h3>
                    </div>
                    {{ Form::open(['route' => ['user.bank.bank-withdraw-submit'] , 'method' => 'post']) }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Bank Name <span style="color: red;">*</span></label>
                                <select id="from_bank_id" class="form-control select2" name="bank" onchange="bank_name(this.value)" required>
                                    <option value="">Select One</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->its_bank_acc_bank_name }}">
                                            {{ $bank->bankName->its_bank_name }} ({{ $bank->its_bank_acc_branch_name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('bank')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="branch_name">Account No <span style="color: red;">*</span></label>
                                <input type="text" readonly name="acc_no" id="acc_no" value="{{ old('acc_no') }}"  placeholder="Account No"  class="form-control" required>
                                @error('acc_no')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label  class="amount" style="display: none;">Bank Amount</label>
                                <input type="text" id="total_amount" name="total_amount"  class="form-control amount" style="display: none;" readonly>
                                <div class="text-danger" id="insufficient"></div> 
                            </div>
                            <div class="form-group">
                                <label for="withdraw_amount">Withdraw Amount(Debit) <span style="color: red;">*</span></label>
                                <input type="number"  name="withdraw_amount" id="check_amount_empty" onkeyup="check_amount(this.value)"  value="{{ old('withdraw_amount') }}" autocomplete="off" required class="form-control" placeholder="Enter Withdraw Amount">
                                @error('withdraw_amount')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description <span style="color: red;">*</span></label>
                                <input type="text" name="description" value="{{ old('description') }}" class="form-control" autocomplete="off" placeholder="Enter Description" required>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="open_date">Withdraw Date <span style="color: red;">*</span></label>
                                <input type="text" name="withdraw_date" value="{{ $current_date }}"  id="datepicker" data-date-format="yyyy-mm-dd"  data-date-end-date="{{ $current_date }}" autocomplete="off" class="form-control" placeholder="Enter Withdraw Date" required>
                                @error('withdraw_date')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
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
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
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
        let url = "{{ route('user.bank.bank-acc-no-ajax') }}";
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
        let bank_amount_url = "{{ route('user.bank.bank-amount') }}";

        $.ajax({  
            type: "GET",
            url: bank_amount_url,
            data: { bank_id: bank_id,_token:_token},
            success: function (result) {
                $('.amount').addClass('d-block');
                $('#total_amount').val(result +'.'+'00');

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
    // Check Amount from Database 
    function check_amount(amount)
    {
        let total_amount = $('#total_amount').val().split('.')[0];
        
        // Banck Select Chek
        if(total_amount == "" )
        {
            alert('Select Bank Name')
            $('.float-right').prop('disabled', true);
            $('#check_amount_empty').val('');

            return false;
        }
        
        let bank_amount_url = "{{ route('user.bank.check-bank-amount') }}";
        let from_bank_id = $('#from_bank_id').val();

        $.ajax({  
            type: "GET",
            url: bank_amount_url,
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
    @if(session()->has('bank_withdraw'))
        Swal.fire(
            "Successfully",
            "{{ session()->get('bank_withdraw') }}",
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
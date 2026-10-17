@extends('branch.layout.master')
@section('bank_details','menu-open')
@section('bank_details_link','active')
@section('cash_transfer','active')
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
    <div class="container-fluid" >
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    Fill Up All Field 
                </div>
            @endif
        </div>
    
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Cash Transfer</h3>
            </div>
            {{ Form::open(['route' => ['branch.bank.cash-transfer-insert'] , 'method' => 'post']) }}
              @csrf
               <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="card-body pb-0">
                            <div class="col-12 p-0">
                                <h3>From</h3>
                            </div>
                            <div class="form-group">
                                <label>Bank Name <span style="color: red;">*</span></label>
                                <select class="form-control select2" id="from_bank_id" name="from_bank_id" onchange="from_bank_name(this.value)" required>
                                    <option value="">Select One</option>
                                    @foreach ($bank_names as $bank_name)
                                        <option value="{{ $bank_name->its_bank_acc_bank_name }}">
                                            {{ $bank_name->bankName->its_bank_name }} ({{ $bank_name->its_bank_acc_branch_name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('from_bank_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Account No <span style="color: red;">*</span></label>
                                <input type="text" readonly class="form-control  form_acc_no" name="from_acc_no_id" placeholder="Account No" required>
                                @error('from_acc_no_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="pb-2">
                                <label  class="amount" style="display: none;">Bank Amount</label>
                                <input type="text" id="total_amount" name="total_amount"  class="form-control amount" style="display: none;" readonly>
                            </div>
                            <div class="text-danger" id="insufficient"></div> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="card-body pt-0 pt-sm-4">
                            <div class="col-12 p-0">
                                <h3>To</h3>
                            </div>
                            <div class="form-group">
                                <label>Bank Name <span style="color: red;">*</span></label>
                                <select class="form-control select2" id="to_bank_id" name="to_bank_id" onchange="to_bank_name(this.value)" required>
                                    <option value="">Select One</option>
                                    @foreach ($bank_names as $bank_name)
                                        <option value="{{ $bank_name->its_bank_acc_bank_name }}">
                                            {{ $bank_name->bankName->its_bank_name }} ({{ $bank_name->its_bank_acc_branch_name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('to_bank_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Account No <span style="color: red;">*</span></label>
                                <input type="text" readonly class="form-control  to_acc_no" name="to_acc_no_id" placeholder="Account No" required >
                                @error('to_acc_no_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount <span style="color: red;">*</span></label>
                                <input type="number" id="check_amount_empty" autocomplete="off" onkeyup="check_amount(this.value)" name="amount" value="{{ old('amount') }}" class="form-control"  placeholder="Enter Amount" required>
                                @error('amount')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Descroption <span style="color: red;">*</span></label>
                                <input type="text"  name="description" value="{{ old('description') }}" class="form-control"  placeholder="Enter Description" required>
                                @error('description')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
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
        $('.select2').select2()
    })
    // Account No Show Script for from
    function from_bank_name(bank_id) 
    {
        let url = "{{ route('branch.bank.bank-acc-no-ajax') }}";
        let _token=$("#_token").val();

        let from_bank_id = $('#from_bank_id').val();
        let to_bank_id = $('#to_bank_id').val();

        // Same Account Alert Script 
        if(from_bank_id == to_bank_id)
        {
            alert('Both account are same');
            $('#to_bank_id').val('')
            $('.float-right').prop('disabled', true);
            return false;
        }
        else{
            $('.float-right').prop('disabled', false);
        }
        // Account No Show Script    
        $.ajax({  
            type: "GET",
            url: url,
            data: { bank_id: bank_id,_token:_token},
            success: function (result) {
              $(".form_acc_no").val(result);
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
    // Account No Show Script for To 
    function to_bank_name(bank_id) 
    {
        let url = "{{ route('branch.bank.bank-acc-no-ajax') }}";
        let _token=$("#_token").val();

        let from_bank_id = $('#from_bank_id').val();
        let to_bank_id = $('#to_bank_id').val();

        // Same Account Alert Script
        if(from_bank_id == to_bank_id)
        {
            alert('Both account are same');
            $('#to_bank_id').val('')
            $('.float-right').prop('disabled', true);
            return false;
        }
        else{
            $('.float-right').prop('disabled', false);
        }
        // Account No Show Script
        $.ajax({  
            type: "GET",
            url: url,
            data: { bank_id: bank_id,_token:_token},
            success: function (result) {
              $(".to_acc_no").val(result);
            }
        });
    }

    // Check Amount from Database 
    function check_amount(amount)
    {
        let from_bank_id = $('#from_bank_id').val();
        let to_bank_id = $('#to_bank_id').val();

        // From Banck Select Check
        if(total_amount == "" )
        {
            alert('Select Bank Name')
            $('.float-right').prop('disabled', true);
            $('#check_amount_empty').val('');

            return false;
        }
        // To Banck Select Check
        if(to_bank_id == "" )
        {
            alert('Select To Bank Name')
            $('.float-right').prop('disabled', true);
            $('#check_amount_empty').val('');

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
    

    @if(session()->has('cash_transfer'))
        Swal.fire(
            "Successfully",
            "{{ session()->get('cash_transfer') }}",
            "success"
        )
    @endif
    @if(session()->has('account_same'))
        Swal.fire(
            "Opps!",
            "{{ session()->get('account_same') }}",
            "error"
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
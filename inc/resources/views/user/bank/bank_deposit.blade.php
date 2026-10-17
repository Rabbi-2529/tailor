@extends('user.layout.master')
@section('bank_details','menu-open')
@section('bank_details_link','active')
@section('bank_deposit','active')
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
                            <h3 class="card-title">Bank Deposit</h3>
                        </div>
                        {{ Form::open(['route' => ['user.bank.bank-deposit-submit'] , 'method' => 'post']) }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Bank Name <span style="color: red;">*</span></label>
                                    <select class="form-control select2" name="bank" onchange="bank_name(this.value)" required>
                                        <option value="">Select One</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->its_bank_acc_bank_name }}">
                                                {{ $bank->bankName->its_bank_name }} ({{ $bank->its_bank_acc_branch_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bank')
                                    <div class="alert alert-danger  mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="acc_no">Account No <span style="color: red;">*</span></label>
                                    <input type="text" readonly name="acc_no" id="acc_no" value="{{ old('acc_no') }}" class="form-control" placeholder="Account No" required>
                                    @error('acc_no')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="accno">Deposit Amount(Credit)<span style="color: red;">*</span></label>
                                    <input type="number" name="deposit_amount" value="{{ old('deposit_amount') }}" class="form-control" autocomplete="off" required placeholder="Enter Deposit Amount">
                                    @error('deposit_amount')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="accno">Description <span style="color: red;">*</span></label>
                                    <input type="text" name="description" value="{{ old('description') }}" class="form-control" autocomplete="off" required placeholder="Enter Description">
                                    @error('description')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="open_date">Deposit Date (Y-M-D)<span style="color: red;">*</span></label>
                                    <input type="text" name="deposit_date" value="{{ $current_date }}" data-date-end-date="{{ $current_date }}" autocomplete="off" id="datepicker" data-date-format="yyyy-mm-dd" class="form-control" placeholder="Enter Deposit Date" required>
                                    @error('deposit_date')
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
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
    $(function () {
        $('.select2').select2();
        //Initialize Datepicker
        $("#datepicker").datepicker({
              autoclose: true,
        });
    })
    // Buttton Submit After Disabled 
    $('form').submit(function() {
         $(this).find("button[type='submit']").prop('disabled',true);
    });
    // Account No Show Script
    function bank_name(bank_id) 
    {
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
    }
    @if(session()->has('bank_deposit'))
        Swal.fire(
            "Successfully",
            "{{ session()->get('bank_deposit') }}",
            "success"
        )
    @endif
</script>
@endsection
@extends('user.layout.master')
@section('bank_details','menu-open')
@section('bank_details_link','active')
@section('open_bank_statement','active')
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
                        <h3 class="card-title">Open Bank Account</h3>
                    </div>
                    {{ Form::open(['route' => ['user.bank.open-bank-account'] , 'method' => 'post']) }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="branch_name">Branch Name <span style="color: red;">*</span></label>
                            <input type="text" name="branch" value="{{ old('branch') }}" class="form-control" autocomplete="off" placeholder="Enter Branch Name" required>
                            @error('branch')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bank Name <span style="color: red;">*</span></label>
                            <select class="form-control select2" name="bank_Id" value="{{ old('name') }}" required>
                                <option value="">Select One</option>
                                <option v-for="bnk in bank" :value="bnk.its_bank_slno">
                                  @{{ bnk.its_bank_name }}
                                </option>
                            </select>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="accno">Account No <span style="color: red;">*</span></label>
                            <input type="text" onkeydown="upperCaseF(this)" name="acc_no" value="{{ old('acc_no') }}" class="form-control" autocomplete="off" placeholder="Enter Account No" required>
                            @error('acc_no')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="open_date">Open Date (Y-M-D)<span style="color: red;">*</span></label>
                            <input type="text" name="open" value="{{ $current_date }}"  class="form-control datepicker" autocomplete="off"  data-date-format="yyyy-mm-dd" placeholder="Enter Open Date" required>
                            @error('open')
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
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    var customer = new Vue({
        el: '#bank',
        data:{
           bank: {!! json_encode($banks) !!},
        }
    });

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Datepicker 
        $(".datepicker").datepicker({
            autoclose: true,
        });

    })
    // Upper Case Character Input
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }
    // Buttton Submit After Disabled 
    $('form').submit(function() {
         $(this).find("button[type='submit']").prop('disabled',true);
    });

    @if(session()->has('bank_acc'))
        Swal.fire(
            "Successfully",
            "{{ session()->get('bank_acc') }}",
            "success"
        )
    @endif
    @if(session()->has('error_entry'))
        Swal.fire(
            "Already",
            "{{ session()->get('error_entry') }}",
            "error"
        )
    @endif
</script>
@endsection
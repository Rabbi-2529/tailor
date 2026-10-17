@extends('user.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('payment_date','active')
@section('content')
<section class="content">
    <div class="container-fluid" id="supplier_bank">
       <div class="row">
            <div class="offset-md-3 col-md-6 pt-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Fill Up All Field 
                    </div>
                @endif
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Supplier Payment Date</h3>
                    </div>
                    {{ Form::open(['route' => ['user.supplier.payment-date-insert'] , 'method' => 'post']) }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Supplier Name<span style="color: red;">*</span></label>
                            <select class="form-control select2" name="sup_name" required>
                                <option value="">Select One</option>
                                <option v-for="sup in supplier" :value="sup.its_sup_slno">
                                    @{{ sup.its_sup_name }}
                                </option>
                            </select>
                            @error('sup_name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Payment Type<span style="color: red;">*</span></label>
                            <select name="p_type" class="form-control select2" id="" required>
                                <option value="">Select One</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Mobile Banking">Mobile Banking</option>
                            </select>
                            @error('p_type')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Amount<span style="color: red;">*</span></label>
                            <input type="number" name="amount" value="{{ old('amount') }}" class="form-control" id="" placeholder="Enter Amount" required>
                            @error('amount')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Payment Date<span style="color: red;">*</span></label>
                            <input type="text" name="pay_date" autocomplete="off" value="{{ old('pay_date') }}" data-date-format="yyyy-mm-dd" class="form-control datepicker" placeholder="Enter Payment Date" required>
                            @error('pay_date')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <!-- /.card-body -->
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
@endsection
@section('custom_script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    var app = new Vue({
        el: '#supplier_bank',
        data: {
            supplier: {!! json_encode($suppliers) !!}
        }
    });

    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        // Initialize Date 
        $(".datepicker").datepicker({
            startDate: new Date(),
            autoclose: true,
        });
    })
    // Buttton Submit After Disabled
    $('form').submit(function() {
       $(this).find("button[type='submit']").prop('disabled',true);
    });
    
    @if(session()->has('payment_date'))
        Swal.fire(
            "Successfully!",
            "{{ session()->get('payment_date') }}",
            "success",
        )
    @endif
</script>
@endsection
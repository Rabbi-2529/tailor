@extends('user.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('add_bank','active')
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
                            <h3 class="card-title">Add Supplier Bank</h3>
                        </div>
                        {{ Form::open(['route' => ['user.supplier.add-bank-insert'] , 'method' => 'post']) }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Branch Name<span style="color: red;">*</span></label>
                                    <input type="text" name="br_name" value="{{ old('br_name') }}" class="form-control" required placeholder="Enter Branch Name">
                                    @error('br_name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Supplier Name<span style="color: red;">*</span></label>
                                    <select class="form-control select2" name="sup_name">
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
                                    <label for="exampleInputPassword1">Bank Name<span style="color: red;">*</span></label>
                                    <select class="form-control select2" name="b_name" required>
                                        <option value="">Select One</option>
                                        <option v-for="bank in banks" :value="bank.its_bank_slno">
                                            @{{ bank.its_bank_name }}
                                        </option>
                                    </select>
                                    @error('b_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Account Name<span style="color: red;">*</span></label>
                                    <input type="text" name="ac_name" value="{{ old('ac_name') }}" class="form-control" required placeholder="Enter Account Name">
                                    @error('ac_name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Account No<span style="color: red;">*</span></label>
                                    <input type="text" name="ac_no" value="{{ old('ac_no') }}" class="form-control" required onkeydown="upperCaseF(this)" placeholder="Enter Account No">
                                    @error('ac_no')
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
@endsection
@section('custom_script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    $(function () {
        $('.select2').select2()
    })
    
    var app = new Vue({
        el: '#supplier_bank',
        data: {
            supplier: {!! json_encode($suppliers) !!},
            banks: {!! json_encode($banks) !!}
        }
    });

    @if(session()->has('sup_bank'))
        Swal.fire(
            "Successfully!",
            "{{ session()->get('sup_bank') }}",
            "success",
        )
    @endif
    // Buttton Submit After Disabled
    $('form').submit(function() {
       $(this).find("button[type='submit']").prop('disabled',true);
    });
    // Upper Case Character Input
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }
</script>
@endsection
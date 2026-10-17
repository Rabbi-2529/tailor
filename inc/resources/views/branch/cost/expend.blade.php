@extends('branch.layout.master')
@section('cost_class','menu-open')
@section('cost_class_link','active')
@section('expend_class','active')
@section('content')
<section class="content">
<div class="container-fluid" id="supplier">
  <div class="row">
    <div class="offset-md-3 col-md-6 pt-4">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Expend</h3>
        </div>
        {{ Form::open(['route' => ['branch.cost.expend-insert'] , 'method' => 'post']) }}
            <div class="card-body">
                
                <div class="form-group row">
                    <label for="payment" class="col-sm-3 col-form-label">Payment <span style="color: red;">*</span></label>
                    <div class="col-9">
                        <input type="number" autocomplete="off" name="total_amount" class="form-control" :value="total_amount" placeholder="Total Amount" required>
                    </div>
                    <div class="offset-sm-3 col-sm-9 col-12">
                        @error('total_amount')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Description <span style="color: red;">*</span></label>
                    <div class="col-9">
                      <input type="text" name="desc" class="form-control"  placeholder="Enter Description" required>
                      @error('desc')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Payment Date <span style="color: red;">*</span></label>
                    <div class="col-9">
                      <input type="text"  name="payment_date" value="{{ $current_date }}" data-date-end-date="{{ $current_date }}" data-date-format="yyyy-mm-dd" autocomplete="off"  class="form-control" id="datepicker" placeholder="Enter Name" required>
                      @error('payment_date')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right ">Submit</button>
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
    
    
    // Buttton Submit After Disabled
    $('form').submit(function() {
       $(this).find("button[type='submit']").prop('disabled',true);
    });
    
    @if(session()->has('success'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('success') }}",
        "success",
      )
    @endif
</script>
@endsection
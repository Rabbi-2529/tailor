@extends('user.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('add_type','active')
@section('content')
  <section class="content">
    <div class="container-fluid" id="pro_type">
      <div class="row">
        <!-- left column -->
        <div class="offset-md-3 col-md-6 pt-5 mt-5">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Product Type</h3>
            </div>
            {{ Form::open(['action' => 'user\ProductInformationController@ProductTypeInsert' , 'method' => 'post']) }}
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Group Name <span style="color: red;">*</span></label>
                      <select name="group_id" class="form-control select2" required>
                        <option value="">Select One</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->its_inv_progrp_slno }}">{{ $group->its_inv_progrp_name }}</option> 
                        @endforeach
                      </select>
                      @error('group_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label>Type Name <span style="color: red;">*</span></label>
                      <input type="text" autocomplete="off" name="type_name" value="{{ old('type_name') }}" class="form-control" placeholder="Enter Type Name" required>
                      @error('type_name')
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
      <!-- /.row -->
    </div><!-- /.container-fluid -->
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
    
    $('form').submit(function() {
         $(this).find("button[type='submit']").prop('disabled',true);
    });
    
    $(function () {
      $('.select2').select2()
    })

    @if(session()->has('type'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('type') }}",
        "success",
      )
    @endif
    @if(session()->has('already_insert'))
      Swal.fire(
        "Already!",
        "{{ session()->get('already_insert') }}",
        "error",
      )
    @endif
</script>
@endsection
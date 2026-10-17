@extends('branch.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('add_name','active')
@section('content')
    <section class="content">
        <div class="container-fluid" id="product_name">
          <div class="row">
            <!-- left column -->
            <div class="offset-md-3 col-md-6 pt-4">
               @if ($errors->any())
                <div class="alert alert-danger">
                  Fill Up All Field 
                </div>
              @endif
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Product Name</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {{ Form::open(['route' => ['branch.ProductInformation.add-name-insert'] , 'method' => 'post']) }}
                  <div class="card-body">
                    <div class="form-group">
                        <label>Supplier Name <span style="color: red;">*</span></label>
                        <select class="form-control select2" name="supplier_id" required>
                            <option value="">Select One</option>
                            <option v-for="sup in supplier" :value="sup.its_sup_slno">
                              @{{ sup.its_sup_name }} (Global)
                            </option>
                        </select>
                        @error('supplier_id')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Group Name <span style="color: red;">*</span></label>
                        <select class="form-control select2" name="group_id" onchange="group_id_catch(this.value)" required>
                            <option value="">Select One</option>
                            @foreach ($groups as $group)
                              <option value="{{ $group->its_inv_progrp_slno }}">{{ $group->its_inv_progrp_name }} </option>
                            @endforeach
                        </select>
                        @error('group_id')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Type Name <span style="color: red;">*</span></label>
                        <select class="form-control select2" name="type_id" id="pro_type_name" required>
                           
                        </select>
                        @error('group_id')
                          <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Name <span style="color: red;">*</span></label>
                        <input type="text" name="product_name"  class="form-control" value="{{ old('product_name') }}" placeholder="Enter Product Name" required>
                        @error('product_name')
                           <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Product Description <span style="color: red;">*</span></label>
                        <input type="text" autocomplete="off" name="description" class="form-control" value="{{ old('description') }}"  placeholder="Enter Product Description" required>
                        @error('description')
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
    $(function () {
      $('.select2').select2()
    })
     
    var app = new Vue({
        el: '#product_name',
        data: {
            supplier: {!! json_encode($suppliers) !!},
        }
    });
    //  Group Id Catch For Product Type Name Script
    function group_id_catch(group_id)
    {
        let url = "{{ route('branch.ProductInformation.group-ajax-for-type') }}";
        $.ajax({  
            type: "GET",
            url: url,
            data: { group_id: group_id},
            success: function (result) {
              $("#pro_type_name").html(result);
            }
        });
    }

    @if(session()->has('already_insert'))
      Swal.fire(
        "Opps!",
        "{{ session()->get('already_insert') }}",
        "error",
      )
    @endif
    @if(session()->has('pro_name'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('pro_name') }}",
        "success",
      )
    @endif
    // Form Submit After Button Disabled
    $('form').submit(function() {
         $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection

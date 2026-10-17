@extends('user.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('add_product','active')
@section('content')
<section class="content">
    <div class="container-fluid" id="product">
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
              <h3 class="card-title">Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {{ Form::open(['route' => ['user.ProductInformation.add-product-insert'] , 'method' => 'post']) }}
            <div class="card-body">
              <div class="form-group">
                <label>Supplier Name <span style="color: red;">*</span></label>
                  <select class="form-control select2" name="supplier_id" onchange="supplier_id_catch(this.value)" required>
                      <option value="">Select One</option>
                      @foreach ($suppliers as $supplier)
                          <option value="{{ $supplier->its_sup_slno }}">{{ $supplier->its_sup_name }} (Global)</option>
                      @endforeach
                  </select>
                  @error('supplier_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Group Name <span style="color: red;">*</span></label>
                  <select class="form-control select2" id="group"  name="group_id" onchange="group_id_catch(this.value)" required>
                      @if(count($group_names) > 0)
                          <option value="">Select One</option>
                              @foreach ($group_names as $group_name)
                              <option value="{{ $group_name->its_proname_group_id }}">
                                  {{ $group_name->groupName->its_inv_progrp_name }}
                              </option>
                          @endforeach
                      @endif
                  </select>
                  @error('group_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
               <div class="form-group">
                  <label>Type Name <span style="color: red;">*</span></label>
                  <select class="form-control select2" name="type_id" id="pro_type_name" onchange="type_id_catch(this.value)" required>
                      
                  </select>
                  @error('type_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Product Name <span style="color: red;">*</span></label>
                  <select class="form-control select2" name="pro_name" id="pro_name" required>
                      
                  </select>
                  @error('pro_name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="buy">Product Buy Price <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" autocomplete="off" name="buy" value="{{ old('buy') }}" placeholder="Enter Product Buy Price" required>
                  @error('buy')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="sell">Product Sell Price <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" autocomplete="off" name="sell" value="{{ old('sell') }}"  placeholder="Enter Product Sell Price" required>
                  @error('sell')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="short">Short Quantity</label>
                  <input type="number" class="form-control" autocomplete="off" name="short" value="{{ old('short') }}" placeholder="Enter Product Short Quantity">
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
  {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">  --}}
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

    // Supplier Id Catch For Group Name Show 
    function supplier_id_catch(supplier_id) 
    {
        let url = "{{ route('user.ProductInformation.supplierId-ajax-for-group') }}";
     
        $.ajax({  
          type: "GET",
          url: url,
          data: { supplier_id: supplier_id},
          success: function (result) {
             $("#group").html(result);
          }
        });
    }
    //  Product Group Id Catch For Product Type Name 
    function group_id_catch(group_id)
    {
        let url = "{{ route('user.ProductInformation.group-ajax-for-type') }}";
        $.ajax({  
            type: "GET",
            url: url,
            data: { group_id: group_id},
            success: function (result) {
              $("#pro_type_name").html(result);
            }
        });
    }
    //  Product Type Id Catch For Product Name 
    function type_id_catch(pro_type_id) 
    {
      let url = "{{ route('user.ProductInformation.type-ajax-for-pro-name') }}";
      
      $.ajax({  
        type: "GET",
        url: url,
        data: { pro_type_id: pro_type_id},
        success: function (result) {
           $("#pro_name").html(result);
        }
      });
    }

    @if(session()->has('product'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('product') }}",
        "success"
      )
    @endif
    @if(session()->has('already_insert'))
      Swal.fire(
        "Opps!",
        "{{ session()->get('already_insert') }}",
        "error"
      )
    @endif
    // Form Submit After Button Disabled
    $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection
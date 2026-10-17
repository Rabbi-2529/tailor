@extends('user.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('add_location','active')
@section('content')
  <section class="content">
    <div class="container-fluid" id="location">
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
              <h3 class="card-title">Add Product Location</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {{ Form::open(['route' => 'user.ProductInformation.product-location-insert' , 'method' => 'post']) }}
            <div class="card-body">
              <div class="form-group">
                  <label>Group Name <span style="color: red;">*</span></label>
                  <select class="form-control select2"   name="group_id" onchange="group_id_catch(this.value)" required>
                    <option value="">Select One</option>
                    @foreach ($groups as $group)
                       <option value="{{ $group->its_inv_progrp_slno  }}">{{ $group->its_inv_progrp_name }}</option>
                    @endforeach
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
                  <select class="form-control select2"  id="pro_name" name="pro_name_id" required>
                      
                  </select>
                  @error('pro_name_id')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Product Block <span style="color: red;">*</span></label>
                  <input type="text" name="block" value="{{ old('block') }}" class="form-control" placeholder="Enter Block" required>
                  @error('block')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Product Self</label>
                  <input type="text" name="self" value="{{ old('self') }}" class="form-control" placeholder="Enter Self">
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
      //Initialize Select2 Elements
      $('.select2').select2()
    })
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

    @if(session()->has('location'))
        Swal.fire(
            "Successfully!",
            "{{ session()->get('location') }}",
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
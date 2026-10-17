@extends('branch.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('view_supplier','active')
@section('content')
   <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('branch/supplier/view') }}">Supplier List</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
   <section class="content">
    <div class="container-fluid" id="supplier">
        <div class="row">
           <div class="offset-md-3 col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Fill Up All Field 
                    </div>
                @endif
        
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Supplier</h3>
                    </div>
                
                    {{ Form::open(['route' => ['branch.supplier.update-info-insert'] , 'method' => 'post']) }}

                    <input type="hidden" name="its_sup_slno" value="{{ $supplier_info->its_sup_slno  }}" class="form-control">

                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" value="{{ $supplier_info->its_sup_name }}" class="form-control" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Person <span style="color: red;">*</span></label>
                            <input type="text" name="person" value="{{ $supplier_info->its_sup_person }}" class="form-control" required>
                            @error('person')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email </label>
                            <input type="email" name="email" value="{{ $supplier_info->its_sup_email }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mobile <span style="color: red;">*</span></label>
                            <input type="number" name="mobile" value="{{ $supplier_info->its_sup_mobile }}" class="form-control" required
                            @error('mobile')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone </label>
                            <input type="number" name="phone" value="{{ $supplier_info->its_sup_phone }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Address <span style="color: red;">*</span></label>
                            <input type="text" name="address" value="{{ $supplier_info->its_sup_address }}" class="form-control" required>
                            @error('address')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Website </label>
                            <input type="text" name="website" value="{{ $supplier_info->its_sup_website }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Complain Number </label>
                            <input type="number" name="complain" value="{{ $supplier_info->its_sup_complain_number }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Open Due Balance</label>
                            <input type="text" name="due_bal" value="{{ $supplier_info->its_sup_due_balance}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Supplier Status <span style="color: red;">*</span>: </label>
                            <input type="radio" name="status" {{ ($supplier_info->its_sup_status == 1)? 'checked':'' }} value="1"> Local
                            <input type="radio" name="status" {{ ($supplier_info->its_sup_status == 2)? 'checked':'' }} value="2"> Global
                            @error('address')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Update</button>
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

  @if(session()->has('update'))
    Swal.fire(
      "Successfully!",
      "{{ session()->get('update') }}",
      "success",
    )
  @endif
  // Buttton Submit After Disabled
    $('form').submit(function() {
       $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection
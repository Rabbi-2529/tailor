<input type="text" value="{{ $name_edit->its_proname_slno }}" name="pro_name_id" hidden>
<div class="card-body p-0">
    <div class="form-group">
        <label class="d-block">Supplier Name</label>
        <select name="supplier_id"  class="form-control select2 " style="width: 100%" required>
            <option  value="">Select One</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->its_sup_slno }}" {{ ($supplier->its_sup_slno == $name_edit->its_proname_sup_id)? 'selected': '' }}>
                  {{ $supplier->its_sup_name }}
                </option>
            @endforeach
        </select>
        @error('supplier_id')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Group Name</label>
        <select class="form-control select2" name="group_id" onchange="group_id_catch(this.value)" required>
            <option value="">Select One</option>
            @foreach ($groups as $grp)
              <option  value="{{ $grp->its_inv_progrp_slno }}" {{ ($grp->its_inv_progrp_slno == $name_edit->its_proname_group_id)? 'selected' : '' }}>
                  {{ $grp->its_inv_progrp_name }}
              </option>
            @endforeach
        </select>
        @error('group_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Type Name <span style="color: red;">*</span></label>
        <select class="form-control select2" name="type_id" id="pro_type_name" required> 
            <option value="">Select One</option>
            @foreach ($types as $type)
                <option value="{{ $type->its_protype_slno }}" {{ ($type->its_protype_slno == $name_edit->its_proname_type_id)? 'selected' : '' }}>
                    {{ $type->its_protype_name }}
                </option>
            @endforeach
        </select>
        @error('group_id')
          <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Product Name</label>
        <input type="text" name="product_name" class="form-control" value="{{ $name_edit->its_proname_product_name }}" placeholder="Enter Group Name" required>
        @error('product_name')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Product Description <span style="color: red;">*</span></label>
        <input type="text" name="description" class="form-control" value="{{ $name_edit->its_proname_product_desc }}" placeholder="Enter Product Description" required>
        @error('description')
          <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
</div>

<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>     

  
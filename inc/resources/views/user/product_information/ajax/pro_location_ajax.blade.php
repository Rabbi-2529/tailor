<input type="text" value="{{ $location_edit->its_inv_proloc_slno }}" name="loc_id" hidden>
<div class="card-body p-0" id="group">
    <div class="form-group">
        <label>Group Name</label>
        <select class="form-control select2"   name="group_id" onchange="group_id_catch(this.value)" required>
            <option value="">Select One</option>
            @foreach ($groups as $grp)
                <option  value="{{ $grp->its_inv_progrp_slno }}" {{ ($grp->its_inv_progrp_slno == $location_edit->its_inv_proloc_group_id)? 'selected' : '' }}>
                    {{ $grp->its_inv_progrp_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">types
        <label>Type Name <span style="color: red;">*</span></label>
        <select class="form-control select2" name="type_id" id="pro_type_name" onchange="type_id_catch(this.value)" required>
            @foreach ($types as $type)
                <option value="{{ $type->its_protype_slno }}" {{ ($type->its_protype_slno == $location_edit->its_inv_proloc_type_id)? 'selected' : '' }}>
                    {{ $type->its_protype_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Product Name <span style="color: red;">*</span></label>
        <select class="form-control select2"  id="pro_name" name="pro_name_id" required>
            @foreach ($pro_names as $name)
                <option  value="{{ $name->its_proname_slno }}" {{ ($name->its_proname_slno == $location_edit->its_inv_proloc_product_id)? 'selected' : '' }}>
                    {{ $name->its_proname_product_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Block</label>
        <input type="text" name="block" class="form-control" value="{{ $location_edit->its_inv_proloc_block }}" placeholder="Enter Black Name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Self</label>
        <input type="text" name="self" class="form-control" value="{{ $location_edit->its_inv_proloc_self }}" placeholder="Enter Self Name">
    </div>
</div>

<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>  

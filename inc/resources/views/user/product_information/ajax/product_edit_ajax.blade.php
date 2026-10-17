<input type="text" value="{{ $pro_edit->its_inv_pro_slno }}" name="pro_id" hidden>
<div class="card-body p-0">
    <div class="form-group">
        <label for="user">Supplier</label>
        <select  class="form-control select2" name="supplier_id" onchange="supplier_id_catch(this.value)" required>
            <option value="">Select One</option>
            @foreach ($suppliers as $supplier)
               <option value="{{ $supplier->its_sup_slno }}" {{ ($supplier->its_sup_slno == $pro_edit->its_inv_pro_sup_id)? 'selected': '' }}>
                    {{ $supplier->its_sup_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Group Name</label>
        <select class="form-control select2" id="group"  name="group_id" onchange="group_id_catch(this.value)" required>
            <option value="">Select One</option>
            @foreach ($group_names as $group_name)
                <option value="{{ $group_name->its_proname_group_id }}" {{ ($group_name->its_proname_group_id == $pro_edit->its_inv_pro_group)? 'selected': '' }}>
                    {{ $group_name->groupName->its_inv_progrp_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Type Name</label>
        <select class="form-control select2" name="type_id" id="pro_type_name" onchange="type_id_catch(this.value)" required>
            <option value="">Select One</option>
            @foreach ($types as $type)
                <option value="{{ $type->its_protype_slno }}" {{ ($type->its_protype_slno == $pro_edit->its_inv_pro_type)? 'selected': '' }}>
                    {{ $type->its_protype_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Product Name</label>
        <select class="form-control select2" name="pro_name" id="pro_name" required>
            <option value="">Select One</option>
            @foreach ($names as $name)
                <option value="{{ $name->its_proname_slno }}" {{ ($name->its_proname_slno == $pro_edit->its_inv_pro_product_name)? 'selected': '' }}>
                    {{ $name->its_proname_product_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Buy Price</label>
        <input type="text" name="buy" class="form-control" value="{{ $pro_edit->its_inv_pro_buy_price }}" placeholder="Enter Black Name" required>
        
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Sell Price</label>
        <input type="text" name="sell" class="form-control" value="{{ $pro_edit->its_inv_pro_sell_price }}" placeholder="Enter Self Name" required>
        
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Short Qty</label>
        <input type="text" name="short" class="form-control" value="{{ $pro_edit->its_inv_pro_short }}" placeholder="Enter short qty">
        
    </div>
</div>
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>  
  


<input type="text" value="{{ $type_edit->its_protype_slno }}" name="type_id" hidden>
<div class="card-body p-0">  
    <div class="form-group">
        <label for="exampleInputEmail1">Group Name <span style="color: red;">*</span></label>
        <select name="group_id" class="form-control select2" required>
          <option value="">Select One</option>
          @foreach ($groups as $group)
              <option {{ ($group->its_inv_progrp_slno == $type_edit->its_protype_group_id) ? 'selected':'' }} value="{{ $group->its_inv_progrp_slno }}">
                {{ $group->its_inv_progrp_name }}
              </option> 
          @endforeach
        </select>
        @error('group_id')
          <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Product Type Name</label>
      <input type="text" name="type_name" class="form-control"  value="{{ $type_edit->its_protype_name }}" required>
      @error('type_name')
        <div class="alert alert-danger">{{ $message }}</div>
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

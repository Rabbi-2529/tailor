




<input type="text" value="{{ $group_edit->its_inv_progrp_slno }}" name="grp_id" hidden>
<div class="card-body p-0" id="group">
    <div class="form-group">
        <label for="exampleInputEmail1">Group Name</label>
        <input type="text" name="name" class="form-control"  value="{{ $group_edit->its_inv_progrp_name }}" required>
        @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
      


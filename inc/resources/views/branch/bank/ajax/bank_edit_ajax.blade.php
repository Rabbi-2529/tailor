
<input type="text" value="{{ $bank_edit->its_bank_acc_slno }}" name="bank_acc_Id" hidden>
<div class="card-body p-0" id="group">
    <div class="form-group">
      <label for="branch">Branch Name</label>
      <input type="text" name="branch" class="form-control" value="{{ $bank_edit->its_bank_acc_branch_name }}" required>
    </div>
    <div class="form-group">
        <label for="bank">Bank</label>
        <select name="bank_Id"  class="form-control select2" required>
          <option value="">Select One</option>
          @foreach ($banks as $bank)
          <option value="{{ $bank->its_bank_slno }}" {{ ($bank->its_bank_slno == $bank_edit->its_bank_acc_bank_name)? 'selected': '' }}>
                {{ $bank->its_bank_name }}
              </option>
          @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="acc_no">Account Name</label>
        <input type="text" name="acc_no" class="form-control" value="{{ $bank_edit->its_bank_acc_acc_no }}" required>
    </div>
</div>
  

<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function () {
    $('.select2').select2()
  })
</script>

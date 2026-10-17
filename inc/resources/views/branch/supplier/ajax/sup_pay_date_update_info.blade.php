<div class="card-body p-0">
    <input type="hidden" name="pay_date_id"  value="{{ $pay_date_info->its_sup_pay_date_id }}"  class="form-control">
    <div class="form-group">
        <label>Supplier Name</label>
        <select class="form-control select2" name="sup_name" required>
            <option value="">Select One</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->its_sup_slno }}" {{ ($supplier->its_sup_slno == $pay_date_info->its_sup_id)? 'selected':'' }}>
                  {{ $supplier->its_sup_name }}
                </option>
            @endforeach
        </select>
        @error('sup_name')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Payment Type</label>
        <select name="p_type" class="form-control select2" id="" required>
            <option value="">Select One</option>
            <option {{ ($pay_date_info->its_payment_type == "Cash")? 'selected':'' }} value="Cash">Cash</option>
            <option {{ ($pay_date_info->its_payment_type == "Cheque")? 'selected':'' }} value="Cheque">Cheque</option>
            <option {{ ($pay_date_info->its_payment_type == "Mobile Banking")? 'selected':'' }} value="Mobile Banking">Mobile Banking</option>
        </select>
        @error('p_type')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Amount</label>
        <input type="number" name="amount" value="{{ $pay_date_info->its_amount }}" class="form-control" required>
        @error('amount')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Payment Date</label>
        <input type="text" name="pay_date" autocomplete="off" value="{{ $pay_date_info->its_payment_date }}" data-date-format="yyyy-mm-dd" class="form-control datepicker" required>
        @error('pay_date')
        <div class="alert alert-danger mt-2">{{ $message }}</div>
        @enderror
    </div>
    
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
    
</div>
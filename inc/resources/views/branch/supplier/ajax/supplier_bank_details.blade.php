<div class="card-body p-0">
    <table class="table table-bordered table-striped">
        <tr class="font-weight-bold">
            <td>Branch Name</td>
            <td>Bank Name</td>
            <td>Account Name</td>
            <td>Account No</td>
        </tr>
        @foreach ($bank_details as $bank)
        @php
            $bank_names = App\Models\IglTailorBank::where('its_bank_slno',$bank->its_bank_id)->get();
        @endphp
            <tr>
                <td>{{ $bank->its_branch_name}}</td>
                <td>
                    @foreach ($bank_names as $bank_name)
                        {{ $bank_name->its_bank_name }}
                    @endforeach
                </td>
                <td>{{ $bank->its_bank_acc_name}}</td>
                <td>{{ $bank->its_acc_no}}</td>
            </tr>
        @endforeach
    </table>
</div>
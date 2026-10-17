<table  class="table table-bordered table-striped">
    <thead class="border-top">
    <tr>
        <th>SL</th>
        <th>Date</th>
        <th>Description</th>
        <th class="text-right">Debit</th>
        <th class="text-right">Credit</th>
        <th class="text-right">Balance</th>
    </tr>
    </thead>
    <tbody>
        @php
            $debit = 0;
            $credit = 0;
            $balance = 0;
        @endphp
        @foreach ($account_statements as $account_statement)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{ $account_statement->acc_pay_date }}</td>
            <td>{{ $account_statement->acc_description }}</td>
            <td class="text-right">
            {{ $account_statement->acc_debit }}<span>.00</span>
            @php
                $debit += $account_statement->acc_debit
            @endphp
            </td>
            <td class="text-right">
            {{ $account_statement->acc_credit }}<span>.00</span>
            @php
                $credit += $account_statement->acc_credit
            @endphp
            </td>
            <td class="text-right">
            @php
                $balance = $credit - $debit ;
            @endphp
                {{  $balance }}<span>.00</span>
            </td>
        </tr>
        @endforeach        
    </tbody>
    <tfoot>
    <tr class="font-weight-bold">
        <td></td>
        <td></td>
        <td class="text-right">Total Discount : 
        {{ $customer_discount + $supplier_discount }}<span>.00</span>
        </td>
        <td class="text-right">{{ $debit }}<span>.00</span></td>
        <td class="text-right">{{ $credit }}<span>.00</span></td>
        <td class="text-right">{{ $balance }}<span>.00</span></td>
    </tr>
    </tfoot>
</table>
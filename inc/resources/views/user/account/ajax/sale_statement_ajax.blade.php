<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>SL</th>
            <th>Date</th>
            <th>Product Name</th>
            <th>Description</th>
            <th class="text-right">Qty</th>
            <th class="text-right">Price</th>
            <th class="text-right">Amount</th>
        </tr>
    </thead>
    <tbody>
        @php
            $sl = 0;
            $sale_total_amount = 0;
        @endphp
        @foreach ($sale_statements as $sale)
            @php
              $product_info = App\Models\IglTailorInvProductName::product_info($sale->productDetails->its_inv_pro_product_name);
              $sub_total = $sale->its_inv_det_sell_qty * $sale->its_inv_det_sell_price;
              $sale_total_amount += $sub_total;
            @endphp
            <tr>
                <td>{{ ++$sl }}</td>
                <td>{{ $sale->its_inv_det_entry_date }}</td>
                <td>{{ $product_info->its_proname_product_name  }}</td>
                <td>{{ $product_info->its_proname_product_desc  }}</td>
                <td class="text-right">{{ $sale->its_inv_det_sell_qty }}</td>
                <td class="text-right">{{ $sale->its_inv_det_sell_price }}<span>.00</span></td>
                <td class="text-right">{{ $sub_total }}<span>.00</span></td>
            </tr>  
        @endforeach
        <tr>
            <td colspan="5"></td>
            <td class="text-right">Total Amount</td>
            <td class="text-right">{{ $sale_total_amount }}<span>.00</span></td>
        </tr>
         
    </tbody>
    
</table>
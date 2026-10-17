@php
    $total_amount = 0;
@endphp
@if (count($product_buy) > 0)
    <input type="hidden" value="1" id="addToCartCheck">
@else
    <input type="hidden" value="0" id="addToCartCheck">
@endif
@foreach ($product_buy as $product)
    @php
        $total_amount += $product->its_total_price;
    @endphp
    <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $product->product->productNamepro->its_proname_product_name }}</td>
        <td>{{ $product->its_qty }}</td>
        <td class="text-right">{{ $product->its_price }}<span>.00</span></td>
        <td class="text-right">{{ $product->its_total_price  }}<span>.00</span></td>
        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="delete_item('{{ route('branch.buy.cart-product-delete',['temp_sale_slno' => $product->its_tem_pro_sale_slno]) }}')">
                <i class="fas fa-minus"></i>
            </button>
        </td>
    </tr>
@endforeach
@if (count($product_buy) > 0)
    <tr class="font-weight-bold">
    <td></td>
    <td></td>
    <td></td>
    <td class="text-right">Total Amount </td>
    <td class="text-right" id="total_amount">{{ $total_amount }}<span>.00</span></td>
    <td></td>
</tr>
@endif


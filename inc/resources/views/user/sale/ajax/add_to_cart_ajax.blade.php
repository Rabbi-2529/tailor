
@php
    $subTotal = 0;
@endphp
@if (count($product_sales) > 0)
    <input type="hidden" value="1" id="addToCartCheck">
@else
    <input type="hidden" value="0" id="addToCartCheck">
@endif
@foreach ($product_sales as $product_sale)
    @php
        $subTotal += $product_sale->its_total_price;
    @endphp
    <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $product_sale->product->productNamepro->its_proname_product_name }}</td>
        <td>{{ $product_sale->its_qty }}</td>
        <td class="text-right">{{ $product_sale->its_price }}<span>.00</span></td>
        <td class="text-right">{{ $product_sale->its_total_price }}<span>.00</span></td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="delete_data('{{ route('user.sale.get-cart-delete',['temp_id' => $product_sale->its_tem_pro_sale_slno]) }}')">
                <i class="fas fa-minus"></i>
            </button>
        </td>
    </tr>

    <input type="hidden" id="product_add_check" value="1">  
@endforeach
@if (count($product_sales) > 0)
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right">Discount</td>
        <td class="text-right"><input type="text" class="form-control text-right" autocomplete="off" name="discount" onkeyup="cart_discount(this.value)" placeholder="Discount" style="height: 26px;"></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="1"></td>
        <td colspan="1"></td>
        <td colspan="2" class="text-right"><b>Total Amount</b></td>
        <td colspan="1" class="text-right" id="cart_subtotal_td">{{ $subTotal }}<span>.00</span></td>
        <td></td>
       <input type="hidden"  value="{{ $subTotal }}" id="cart_subtotal">
        <input type="hidden" name="total_amount"  value="{{ $subTotal }}" id="total_amount">
    </tr>
@endif



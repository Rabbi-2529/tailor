   
@foreach($product_lists as $product)
    @php
        $total_qtys = App\Models\IglTailorInventoryDetails::total_quantity($product->its_inv_pro_slno);
    @endphp
    <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $product->productNamepro->its_proname_product_name }}</td>
        <td>{{ $product->productGrouppro->its_inv_progrp_name }}</td>
        <td>{{ $product->productTypepro->its_protype_name }}</td>
        <td class="text-center">
            @if (count($total_qtys) > 0)
                @foreach ($total_qtys as $total_qty)
                @if ($total_qty->buy_qty != "")
                    @php
                        $total_qty = $total_qty->buy_qty - $total_qty->sell_qty
                    @endphp
                    {{ $total_qty }}
                @else
                    0
                @endif
                @endforeach
            @else
                0
            @endif
        </td>
        <td class="text-right">
          {{ $product->its_inv_pro_buy_price }}<span>.00</span>
          <input type="hidden" name="product_price" id="product_price{{ $product->its_inv_pro_slno }}" value="{{ $product->its_inv_pro_buy_price }}" class="form-control">
        </td>
        <td class="text-right">
            <div class="row">
                <div class="col-8">
                    <input type="text" autocomplete="off" name="product_quantity" id="product_qty{{ $product->its_inv_pro_slno }}" class="form-control" placeholder="Qty">
                </div>
                <div class="col-4 p-0">
                     <button type="button" onclick="addToCart({{ $product->its_inv_pro_slno }})"   class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>
                     </button>
                </div>
            </div>
        </td>
    </tr>
@endforeach

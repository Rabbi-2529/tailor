    @php
        $sl= 0;
    @endphp
    @foreach ($products as $pro)
        @php
            $total_qtys = App\Models\IglTailorInventoryDetails::user_total_quantity($pro->its_inv_pro_slno);
        @endphp
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{ $pro->productNamepro->its_proname_product_name }}</td>
            <td>{{ $pro->productGrouppro->its_inv_progrp_name }}</td>
            <td>{{ $pro->productTypepro->its_protype_name }}</td>
            <td class="text-center" id="available_qty{{ $pro->its_inv_pro_slno }}">
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
            <td id="price{{ $pro->its_inv_pro_slno }}"  class="text-right">{{ $pro->its_inv_pro_sell_price }}<span>.00</span></td>
            <td class="text-center">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" autocomplete="off" name="qty" id="qty{{ $pro->its_inv_pro_slno }}" class="form-control"  placeholder="Qty" >
                </div>
                <div class="col-md-4 p-0">
                    <button type="button" id="addToCart" data-id="{{ $pro->its_inv_pro_slno }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            </td>
        </tr>  
    @endforeach

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $com = Auth::user()->UserDetails->its_user_com_id;
            $bran = Auth::user()->UserDetails->its_user_bran_id;
            $submit_by = Auth::user()->its_slno;

            if (
                App\Models\IglTailorTemporary::where('its_temp_com_id',$com)
                                             ->where('its_temp_bran_id',$bran)
                                             ->where('its_temp_submit_by','!=',$submit_by)
                                             ->exists()
            ) 
            {
                $latest_order_id = App\Models\IglTailorTemporary::select('its_temp_order_id')
                                                                ->where('its_temp_com_id',$com)
                                                                ->where('its_temp_bran_id',$bran)
                                                                ->where('its_temp_submit_by','!=',$submit_by)
                                                                ->latest('its_temp_submit_at')->first()->its_temp_order_id;
                
                $order_id = $latest_order_id + 1;                                              
            } 
            elseif(
                $latest_order_id = App\Models\IglTailorAddOrder::where('its_add_order_com_id',$com)
                                                                ->where('its_add_order_bran_id',$bran)
                                                                ->exists()
            ) 
            {
                $latest_order_id = App\Models\IglTailorAddOrder::select('its_add_order_order_id')
                                                                ->where('its_add_order_com_id',$com)
                                                                ->where('its_add_order_bran_id',$bran)
                                                                ->latest('its_add_order_submit_at')->first()->its_add_order_order_id;
                $order_id = $latest_order_id + 1;                                
            }
            else{
                $order_id = $branch_order_id_set = App\Models\IglTailorBranch::where('its_branch_id',$bran)->first()->its_branch_order_no;
            }

            
            $subTotal = 0;
        @endphp
        @foreach ($cart_content as $content)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($content->its_temp_pname == 'mojib_cort')
                        Mojib Cort
                    @else
                        {{ $content->its_temp_pname }}
                    @endif
                    <input type="hidden" value="{{ $content->its_temp_pname }}" name="p_name[]">
                </td>
                <td class="text-right">{{ $content->its_temp_price }}</td>
                <td>
                    {{ $content->its_temp_qty }}
                    <input type="hidden" name="qty" value="{{ $content->its_temp_qty }}">
                </td>
                <td class="text-right">
                    <input type="hidden"  value="{{ $content->its_temp_total_price }}" name="price">
                    {{ $content->its_temp_total_price }}
                </td>
                @php
                    $subTotal += $content->its_temp_total_price;
                @endphp
                <input type="hidden" value="{{ $content->its_temp_slno }}" name="temp_slNo[]" class="temp_slNo">

                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="delete_data('{{ route('user.order.get-cart-delete',['id' => $content->its_temp_slno]) }}')">
                        <i class="fas fa-minus"></i>
                    </button>
                </td>
            </tr>
            
            @endforeach

            @if (isset($order_id))  
                <input type="hidden" value="{{ $order_id }}" name="order_id">
            @else
                 <input type="hidden" value="1" name="order_id"> 
            @endif

            @if (count($cart_content) > 0)
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="2" class="text-right"><b>Total Amount : </b></td>
                    <td colspan="1" class="text-right">{{ $subTotal }}</td>
                    <td></td>
                </tr>
            @endif

    </tbody>
</table>


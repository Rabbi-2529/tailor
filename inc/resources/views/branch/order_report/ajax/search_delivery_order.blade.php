@foreach ($deliveries as $delivery)
    <tr>
    <td>{{ $loop->index+1 }}</td>
    <td>
        @if(isset($delivery->its_add_order_user_id))
            @php
            $user_id = $delivery->its_add_order_user_id;
            $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
            @endphp
            {{ $user_info->UserDetailsUser->its_username }}			
        @else
            Branch
        @endif
    </td>
    <td>{{ $delivery->its_add_order_order_id }}</td>
    <td>{{ $delivery->its_add_order_receive_date }}</td>
    <td>{{ $delivery->its_add_order_delivery_date }}</td>
    <td>{{ $delivery->customer_name->its_cus_name }}</td>
    <td>{{ $delivery->customer_name->its_cus_mobile }}</td>
    </tr>                                
@endforeach 
@foreach ($completes as $complete)
    <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>
            @if(isset($complete->its_add_order_user_id))
            @php
                $user_id = $complete->its_add_order_user_id;
                $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
            @endphp
            {{ $user_info->UserDetailsUser->its_username }}			
            @else
              Branch
            @endif
        </td>
        <td>{{ $complete->its_add_order_order_id }}</td>
        <td>{{ $complete->its_add_order_receive_date }}</td>
        <td>{{ $complete->its_add_order_delivery_date }}</td>
        <td>{{ $complete->customer_name->its_cus_name }}</td>
        <td>{{ $complete->customer_name->its_cus_mobile }}</td>
        <td>{{ $complete->order_total_amount->acc_debit }}<span>.00</span></td>
        <td class="text-center text-light" style="cursor: pointer">
        <a  onclick='complete_status("{{ $complete->its_add_order_order_id }}")' id="complete_button{{ $complete->its_add_order_order_id }}"  class="btn btn-success btn-sm">
            Yes
        </a>
        </td>
    </tr>                                
@endforeach 
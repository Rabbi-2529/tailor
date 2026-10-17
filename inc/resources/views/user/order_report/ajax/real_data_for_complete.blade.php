@foreach($completeforDelivery as $complete)
    <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>Branch</td>
        <td>{{ $complete->its_add_order_order_id }}</td>
        <td>{{ $complete->its_add_order_receive_date }}</td>
        <td>{{ $complete->its_add_order_delivery_date }}</td>
        <td>{{ $complete->customer_name->its_cus_name }}</td>
        <td>{{ $complete->customer_name->its_cus_mobile }}</td>
        <td>{{ $complete->order_total_amount->its_order_total_amount }}</td>
        <td>--</td>
        <td>
            @if($complete->its_add_order_status == 4)
                <button id="complete-status" data-id="{{ $complete->its_add_order_slno }}"
                    class="btn btn-danger btn-sm">
                    No
                </button>
            @elseif($complete->its_add_order_status == 5)
                <button id="complete-status" data-id="{{ $complete->its_add_order_slno }}"
                    class="btn btn-success btn-sm">
                    Yes
                </button>
            @endif
        </td>
    </tr>
@endforeach




 
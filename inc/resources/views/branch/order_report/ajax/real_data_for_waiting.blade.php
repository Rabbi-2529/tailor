 @foreach($waitForComplete as $waitFor)
    @php
        $marker_Id_catch = App\Models\IglTailorMakerOrderInformation::where('its_maker_order_add_order_slno',$waitFor->its_add_order_slno)->first();
        $marker_name = App\Models\IglTailorMaker::where('its_maker_slno',$marker_Id_catch->its_maker_order_maker_slno)->first();
    @endphp
    <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $waitFor->its_add_order_order_id }}</td>
        <td>{{ $marker_name->its_maker_name }}</td>
        <td>{{ $waitFor->its_add_product_name }}</td>
        <td>{{ $waitFor->its_add_product_quantity }}</td>
        <td>{{ $waitFor->its_add_order_total_price }}</td>
        <td>{{ $waitFor->its_add_order_receive_date	 }}</td>
        <td>{{ $marker_Id_catch->its_maker_order_maker_delivery_date }}</td>
        <td>
            @if ($waitFor->its_add_order_status == 3)
                <button  id="button-disabled{{ $waitFor->its_add_order_slno }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#waitFor{{ $waitFor->its_add_order_slno }}">
                    No
                </button>
            @elseif($waitFor->its_add_order_status == 4)
                <button  class="btn btn-success btn-sm">
                    Yes
                </button>
            @endif
        </td>
    </tr>
     {{-- Confirm  Modal --}}
    <div class="modal fade" id="waitFor{{ $waitFor->its_add_order_slno  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content col-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <button  data-dismiss="modal" id="complete-status" data-id="{{ $waitFor->its_add_order_slno }}" class="btn btn-success mr-sm-4 complete-status">
                            Yes
                        </button>
                        <button type="button" class="btn btn-secondary ml-sm-4" data-dismiss="modal">
                            No
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endforeach
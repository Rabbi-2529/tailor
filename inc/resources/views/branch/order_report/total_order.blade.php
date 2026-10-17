@extends('branch.layout.master')
@section('content')
     <section class="content">
        <div class="row">
          <div class="col-12 pt-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total Order</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Order Reciever</th>
                    <th>Order ID</th>
                    <th class="text-right">Price</th>
                    <th>Status</th>
                    <th>View</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php
                     $sl= 0;
                  @endphp
                  @foreach ($total_order as $order)
                    <tr>
                      <td>{{ ++$sl }}</td>
                      <td>
                          @if(isset($order->order_total_amount->acc_user_id))
                            @php
                              $user_id = $order->order_total_amount->acc_user_id;
                              $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                            @endphp
                            {{ $user_info->UserDetailsUser->its_username }}				
                          @else
                            Branch
                          @endif
                      </td>
                      <td>{{ $order->its_add_order_order_id }}</td>
                      <td class="text-right">
                       {{ $order->order_total_amount->acc_debit }}<span>.00</span>
                      </td>
                      <td>
                        @php
                            $order_count = App\Models\IglTailorAddOrder::order_count($order->its_add_order_order_id);
                            $order_status_count = App\Models\IglTailorAddOrder::order_status_count($order->its_add_order_order_id, $order->its_add_order_status);
                        @endphp
                    
                          @if (
                              $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 2
                              && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                          )
                            Receive
                          @elseif(
                              $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 3
                              && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                          )
                            Processing
                          @elseif(
                              $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 4
                              && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                          )
                            Complete
                          @elseif(
                              $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 5
                              && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                          )
                            Delivery
                          @else
                            Pending..
                          @endif
                      </td>
                      <td class="text-center">
                        @if (
                              $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 2
                              && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                          )
                            @if ($order->its_add_order_submit_by == Auth::User()->its_slno )
                              <a href="{{ route('branch.OrderReport.receive-order-view', base64_encode($order->its_add_order_order_id)) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                              </a>
                            @else
                                Receive
                            @endif
                          @elseif(
                              $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 3
                              && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                          )
                            @if ($order->its_add_order_submit_by == Auth::User()->its_slno )
                              <a href="{{ route('branch.OrderReport.processing-order-view', base64_encode($order->its_add_order_order_id)) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                              </a>
                            @else
                                Processing...
                            @endif
                          @elseif(
                              $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 4
                              && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                          )
                            Complete
                          @elseif(
                              $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 5
                              && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                          )
                            Delivery
                          @else
                           @if ($order->its_add_order_submit_by == Auth::User()->its_slno )
                              <a href="{{ route('branch.OrderReport.processing-order-view', base64_encode($order->its_add_order_order_id)) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                              </a>
                            @else
                                Pending..
                            @endif
                        @endif
                      </td>
                    </tr> 
                  @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
@endsection
@section('custom_style')
<link rel="stylesheet" href="{{ asset('assets/datatable/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.dataTables.min.css') }}">
@endsection
@section('custom_script')
<script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
<script>
    $(document).ready(function() {
      let table = $('#example1').DataTable( {
        responsive: true
      });
    });
 </script>
@endsection
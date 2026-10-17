@extends('branch.layout.master')
@section('order_report_class', 'menu-open')
@section('order_report_class_link', 'active')
@section('receiving_class', 'active')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12 pt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Receive List</h3>
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
                                    $sl = 0;
                                @endphp
                                @foreach ($recieves as $rcv)
                                    <tr>
                                        <td>{{ ++$sl }}</td>
                                        <td>
                                            @if (isset($rcv->order_total_amount->acc_user_id))
                                                @php
                                                    $user_id = $rcv->order_total_amount->acc_user_id;
                                                    $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')
                                                        ->where('its_user_user_id', $user_id)
                                                        ->first();
                                                @endphp
                                                {{ $user_info->UserDetailsUser->its_username }}
                                            @else
                                                Branch
                                            @endif
                                        </td>
                                        <td>{{ $rcv->its_add_order_order_id }}</td>
                                       <td class="text-right">
    {{ $rcv->order_total_amount ? $rcv->order_total_amount->acc_debit . '.00' : 'N/A' }}
</td>

                                        <td>
                                            @php
                                                $order_count = App\Models\IglTailorAddOrder::order_count($rcv->its_add_order_order_id);
                                                $order_status_count = App\Models\IglTailorAddOrder::order_status_count($rcv->its_add_order_order_id, $rcv->its_add_order_status);
                                            @endphp
                                            @if ($order_count->count_order == $order_status_count->count_status && $order_count->its_add_order_status == 2 && $order_count->its_add_order_status == $order_status_count->its_add_order_status)
                                                Receive
                                            @else
                                                Pending...
                                            @endif


                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('branch.OrderReport.receive-order-view', base64_encode($rcv->its_add_order_order_id)) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
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
            let table = $('#example1').DataTable({
                responsive: true
            });
        });

    </script>
@endsection

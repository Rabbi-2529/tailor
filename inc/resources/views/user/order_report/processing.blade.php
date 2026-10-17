@extends('user.layout.master')
@section('order_report_class','menu-open')
@section('order_report_class_link','active')
@section('processing_class','active')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Processing Report</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Processing</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>SL</th>
                        <th>Order Reciever</th>
                        <th>Order ID</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                    $sl= 0;
                  @endphp
                  @foreach ($processing as $pro)
                    <tr>
                      <td>{{ ++$sl }}</td>
                      <td>
                        @if(isset($pro->user_order_total_amount->acc_user_id))
                          @php
                            $user_id = $pro->user_order_total_amount->acc_user_id;
                            $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                          @endphp
                          {{ $user_info->UserDetailsUser->its_username }}		
                        @else
                          Branch
                        @endif
                      </td>
                      <td>{{ $pro->its_add_order_order_id }}</td>
                      <td class="text-right">
                          {{ $pro->user_order_total_amount->acc_debit }}<span>.00</span>
                      </td>
                      <td>
                          Processing...
                      </td>
                      <td class="text-center">
                          <a href="{{ route('user.OrderReport.processing-order-view', base64_encode($pro->its_add_order_order_id)) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                          </a>
                      </td>
                    </tr> 
                  @endforeach
                </table>
              </div>
          </div>
        </div>
      </div>
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
      var table = $('#example1').DataTable( {
          rowReorder: {
              selector: 'td:nth-child(2)'
          },
          responsive: true
      });
    });
</script>
@endsection
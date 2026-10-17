@extends('user.layout.master')
@section('order_report_class','menu-open')
@section('order_report_class_link','active')
@section('order_details','active')
@section('content')
    <section class="content">
      <div class="row">
        <div class="col-12 pt-4">
          <div class="card">
            <div class="card-header row m-0">
                <h3 class="card-title mt-2 col-8">Show Order Details</h3>
                  <form action="{{ route('user.OrderReport.search-order-details') }}" method="POST" class="col-sm-4 col-12 pl-0" id="searchOrderReport">
                    @csrf
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <p  class="d-blick m-1" style="font-size:18px;font-family: inherit;">Order ID</p>
                        <input type="text" name="order_id" value="{{ (isset($order_id)? $order_id: '') }}" class="form-control search" placeholder="Search"  aria-label="Search" required>
                        <div class="input-group-append">
                          <button type="submit" class="input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                            aria-hidden="true"></i></button>
                        </div>
                    </div>
                  </form>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              @if (isset($searcResult))
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Maker Name</th>
                      <th>Proudct</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Order Receive Date</th>
                      <th>Order Delivery Date</th>
                      <th>Maker Delivery Date</th>
                      <th>Complete</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($searcResult as $searcRes)
                            @php
                              if (App\Models\IglTailorMakerOrderInformation::where('its_maker_order_add_order_slno',$searcRes->its_add_order_slno)->exists()) {
                                  $marker_Id_catch = App\Models\IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_add_order_slno',$searcRes->its_add_order_slno)->get();
                                }
                            @endphp
                          <tr>
                              <td>{{ $loop->index+1 }}</td>
                              @if (isset($marker_Id_catch))
                                <td>
                                  @foreach ($marker_Id_catch as $marker_Id)
                                      {{ $marker_Id->maker_name->its_maker_name }}
                                  @endforeach
                                </td>  
                              @else
                                <td></td>
                              @endif
                              <td>{{ $searcRes->its_add_product_name }}</td>
                              <td>{{ $searcRes->its_add_product_quantity }}</td>
                              <td>{{ $searcRes->its_add_order_total_price }}</td>
                              <td>{{ $searcRes->its_add_order_receive_date }}</td>
                              <td>{{ $searcRes->its_add_order_delivery_date }}</td>
                              @if (isset($marker_Id_catch))
                                <td>
                                  @foreach ($marker_Id_catch as $marker_Id)
                                      {{ $marker_Id->its_maker_order_maker_delivery_date }}
                                  @endforeach
                                </td>  
                              @else
                                <td></td>
                              @endif
                              <td>
                                @if ($searcRes->its_add_order_status == 4 || $searcRes->its_add_order_status == 5 )
                                    Complete
                                    @else
                                    Incomplete
                                @endif
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
                @endif 
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
@extends('branch.layout.master')
@section('order_report_class','menu-open')
@section('order_report_class_link','active')
@section('waiting_class','active')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order Waiting Report</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Waiting For Complete</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th width="5%">SL</th>
                <th>Order ID</th>
                <th>Maker Name</th>
                <th>Proudct Name</th>
                <th>Qty</th>
                <th class="text-right">Price</th>
                <th>Order Receive</th>
                <th>Maker Delivery</th>
                <th>Complete</th>
              </tr>
              </thead>
              <tbody  id="realDateShow">
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
                    <td class="text-right">{{ $waitFor->its_add_order_total_price }}</td>
                    <td>{{ $waitFor->its_add_order_receive_date	 }}</td>
                    <td>{{ $marker_Id_catch->its_maker_order_maker_delivery_date	}}</td>
                    <td>
                      @if ($waitFor->its_add_order_status == 3)
                          <button id="button-disabled{{ $waitFor->its_add_order_slno }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#waitFor{{ $waitFor->its_add_order_slno }}">
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
              </tbody>
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
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
      $(document).ready(function() {
        let table = $('#example1').DataTable( {
          responsive: true
        });
      });

    $(document).on('click','#complete-status',function(e){
        let add_order_slNo = $(this).data('id');

        $('#button-disabled'+add_order_slNo).prop('disabled',true)

        $.ajax({
            url: '{{ route('branch.OrderReport.complete-status-change') }}',
            type: 'get',
            data: {add_order_slNo:add_order_slNo},
            success: function(result){
                return  realData();
                $('#button-disabled').prop('disabled',false)
            },
        });
    });

    function realData(){
      $.ajax({
          url: '{{ route('branch.OrderReport.real-data-for-waiting') }}',
          type: 'get',
          dataType: 'html',
          success: function(result){
            $('#realDateShow').html(result);
              Swal.fire(
                "Successfully",
                "Change Complete Status",
                "success"
              )
          },
      });
    }
</script>
@endsection
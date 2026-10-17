@extends('user.layout.master')
@section('order_report_class','menu-open')
@section('order_report_class_link','active')
@section('processing_class','active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Order View</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('user/OrderReport/processing') }}">Order Processing Report</a></li>
                 <!-- <li class="breadcrumb-item active">DataTables</li>  -->
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
           
     <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                  <div class="row">
                    <div class="col-4">
                      <h3 class="card-title">Processing</h3>
                    </div>
                    <div class="col-8 text-right">
                      <h6 >
                        <a style="cursor:pointer;color:#007bff" data-toggle="modal" data-target="#changeDeliveryDate">
                          Change Order Delivery Date
                        </a>
                      </h6>
                    </div>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h6>Order Id : {{ $single_order_info->its_add_order_order_id }}</h6>
                <h6 class="pb-2">
                    Customer Name : {{ $single_order_info->customer_name->its_cus_name }} 
                    ({{ $single_order_info->customer_name->its_cus_mobile }})
                </h6> 
                <div class="table-responsive">  
                  <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Product Name</th>
                          <th>Product Quantity</th>
                          <th>
                            Maker Name
                          </th>
                          <th>Standard</th>
                          <th>Classical</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($order_info as $order)
                          <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $order->its_add_product_name }}</td>
                            <td>{{ $order->its_add_product_quantity }}</td>
                            <td> 
                                @php
                                    $maker_slno = App\Models\IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_add_order_slno',$order->its_add_order_slno)->first();
                                @endphp
                                <button class="btn btn-info btn-sm"  data-toggle="modal" data-target="#makerUpdateForOrderModal{{ $order->its_add_order_slno }}">
                                    {{ $maker_slno->maker_name->its_maker_name }}
                                </button> 
                            </td>  
                            <td>
                                <a  href="{{ route('user.OrderReport.make-standard-print', [ $order->its_add_product_name, base64_encode($maker_slno->its_maker_order_slno) ]) }}" target="__blank" class="btn btn-success btn-sm" >
                                  Print
                                </a> 
                            </td>
                            <td>
                                <a  href="{{ route('user.OrderReport.make-classical-print', [ $order->its_add_product_name, base64_encode($maker_slno->its_maker_order_slno) ]) }}" target="__blank" class="btn btn-success btn-sm">
                                  Print
                                </a> 
                            </td>
                          </tr> 
                            <div class="modal fade" id="makerUpdateForOrderModal{{ $order->its_add_order_slno }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('user.OrderReport.maker-update-for-order') }}" method="get" id="makerUpdateForOrder">
                                      @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Maker Select</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body pb-5 pt-3 row">
                                            <div class="col-md-12 pb-2">
                                              <label>Order Delivery Date</label>
                                                <input type="text" disabled value="{{ $order->its_add_order_delivery_date }}" class="form-control">
                                            </div>

                                            <input type="hidden" class="form-control its_add_order_slno" name="its_add_order_slno" value=" {{ $order->its_add_order_slno  }}" >
                                          
                                            <div class="col-md-6">
                                                <label>Maker Name</label>
                                                <select class="form-control its_maker_slno select2" name="its_maker_slno" required style="width:200px">
                                                  <option value="">Select One</option>
                                                  @foreach ($makers_infom as $makers_info)
                                                    <option  {{ ($maker_slno->its_maker_order_maker_slno == $makers_info->its_maker_slno)? 'selected': '' }} value="{{ $makers_info->its_maker_slno }}">{{ $makers_info->its_maker_name }} / {{ $makers_info->its_maker_mobile }}</option> 
                                                  @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 ">
                                              <label for="">Maker Delivery Date</label>
                                              <input type="text" autocomplete="off"  data-date-format="yyyy-mm-dd" value="{{ $maker_slno ->its_maker_order_maker_delivery_date }}" data-date-end-date="{{ $order->its_add_order_delivery_date }}" class="form-control datepicker maker_delivery_date"  name="maker_delivery_date" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                        @endforeach
                      <tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <div class="modal fade" id="changeDeliveryDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('user.OrderReport.delivery-date-change') }}" method="get" id="orderDateChange">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delivery Date Change</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pb-5 pt-4 row">
                        <div class="col-md-6">
                            <label for="">Old Delivery Date</label>
                            <input type="text" disabled value="{{ $single_order_info->its_add_order_delivery_date }}" class="form-control">
                            <input type="hidden" class="form-control order_id" name="order_id" value=" {{ $single_order_info->its_add_order_order_id  }}" >
                        </div>
                        <div class="col-md-6">
                            <label for="">New Delivery Date</label>
                            <input type="text" autocomplete="off" class="form-control datepicker new_delivery_date"  name="new_delivery_date"  data-date-format="yyyy-mm-dd"  placeholder="New Delivery Date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
@endsection

@section('custom_style')
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
  <style>
    .form-control::-webkit-inner-spin-button,
    .form-control::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }
  </style>
@endsection
@section('custom_script')
  <script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
  <script>

      $(function () {
          //Initialize Select2 Elements
          $('.select2').select2();
          $(".datepicker").datepicker({
              startDate: new Date(),
              autoclose: true,
          });
      })

      @if(session()->has('change_success'))
        Swal.fire(
          "Successfully",
          "{{ session()->get('change_success') }}",
          "success"
        )
      @endif

      $('#orderDateChange').on('submit',function(e){
          
          let form = $(this);
          let url  = form.attr('action');
          let type = form.attr('method');
          let order_id = $('.order_id').val();
          let new_delivery_date = $('.new_delivery_date').val();
          let _token = "{{ csrf_token() }}";

          $.ajax({
            type: type,
            url : url,
            data: {order_id:order_id, new_delivery_date:new_delivery_date, _token:_token},
            success: function (result){
              $('.new_delivery_date').val('');
               Swal.fire(
                  "Successfully",
                  "Change Order Delivery Date",
                  "success"
                )
            }
          })
      });

      $('#makerUpdateForOrder').on('submit',function(e){
          let form = $(this);
          let url  = form.attr('action');
          let type = form.attr('method');
          let its_add_order_slno = $('.its_add_order_slno').val();
          let its_maker_slno       = $('.its_maker_slno').val();
          let maker_delivery_date  = $('.maker_delivery_date').val();
          let _token = "{{ csrf_token() }}";

          $.ajax({
            type: type,
            url : url,
            data: { its_add_order_slno:its_add_order_slno, its_maker_slno:its_maker_slno, maker_delivery_date:maker_delivery_date, _token:_token},
            success: function (result){
                Swal.fire(
                  "Successfully",
                  "Change Maker for Order",
                  "success"
                )
            }
          })
      });
   // Buttton Submit After Disabled
    $('form').submit(function() {
       $(this).find("button[type='submit']").prop('disabled',true);
    });
  </script>
@endsection
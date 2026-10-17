@extends('branch.layout.master')
@section('order_report_class','menu-open')
@section('order_report_class_link','active')
@section('receiving_class','active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Order View</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('branch/OrderReport/receive') }}">Order Receive Report</a></li>
                {{-- <li class="breadcrumb-item active">DataTables</li> --}}
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
                    <h3 class="card-title">Receive</h3>
                  </div>
                  <div class="col-8 text-right">
                    <h6>
                      <a style="cursor:pointer;color:#007bff" data-toggle="modal" data-target="#changeOrderDeliveryDate">
                        Change Order Delivery Date
                      </a>
                    </h6> 
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h6>Order ID : {{ $single_order_info->its_add_order_order_id }}</h6>
                <h6 class="pb-2">
                    Customer Name : {{ $single_order_info->customer_name->its_cus_name }} 
                    ({{ $single_order_info->customer_name->its_cus_mobile }})
                </h6> 
                <div class="table-responsive">
                  <table  class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Product Name</th>
                          <th>Product Quantity</th>
                          <th>
                            Maker Select
                          </th>
                          <th>Standard</th>
                          <th>Classical</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($order_info as $order)
                          @php
                              $maker_id_exists = App\Models\IglTailorMakerOrderInformation::where('its_maker_order_add_order_slno',$order->its_add_order_slno)->exists()
                          @endphp
                          <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $order->its_add_product_name }}</td>
                            <td>{{ $order->its_add_product_quantity }}</td>
                            <td> 
                                @if ($maker_id_exists)
                                  @php
                                      $maker_slno = App\Models\IglTailorMakerOrderInformation::with('maker_name')->where('its_maker_order_add_order_slno',$order->its_add_order_slno)->first();
                                  @endphp
                                  <button class="btn btn-info btn-sm"  data-toggle="modal" data-target="#makerUpdateForOrderModal{{ $order->its_add_order_slno }}">
                                    {{ (isset($maker_slno->maker_name))? $maker_slno->maker_name->its_maker_name : ''}}
                                  </button> 
                                @else
                                  <button class="btn btn-info btn-sm"  data-toggle="modal" data-target="#makerSetForOrderModal{{ $order->its_add_order_slno }}">
                                      <i class="fas fa-eye"></i>
                                  </button> 
                                @endif
                            </td>  
                            <td>
                              @if ($maker_id_exists)
                                  <a href="{{ route('branch.OrderReport.make-standard-print', [ $order->its_add_product_name, base64_encode($maker_slno->its_maker_order_slno) ]) }}" target="__blank" class="btn btn-success btn-sm" >
                                    Print
                                  </a> 
                              @endif
                            </td>
                            <td>
                                @if ($maker_id_exists)
                                  <a href="{{ route('branch.OrderReport.make-classical-print', [ $order->its_add_product_name, base64_encode($maker_slno->its_maker_order_slno) ]) }}" target="__blank" class="btn btn-success btn-sm">
                                    Print
                                  </a> 
                              @endif
                            </td>
                          </tr> 
                            {{-- Maker Insert Form  --}}
                            <div class="modal fade" id="makerSetForOrderModal{{ $order->its_add_order_slno }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('branch.OrderReport.maker-set-for-order') }}" method="get" id="makerSetForOrder">
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
                                            <input type="hidden" class="form-control its_add_order_id" name="its_add_order_id" value=" {{ $single_order_info->its_add_order_order_id  }}" >
                                            <input type="hidden" class="form-control its_add_product_name" name="its_add_product_name" value=" {{ $order->its_add_product_name  }}" >
                                            
                                            <div class="col-md-6 row">
                                              <label>Maker Name</label>
                                                <select class="form-control its_maker_slno select2" name="its_maker_slno" required style="width:200px">
                                                  <option value="">Select One</option>
                                                  @foreach ($makers_infom as $makers_info)
                                                    <option value="{{ $makers_info->its_maker_slno }}">{{ $makers_info->its_maker_name }} / {{ $makers_info->its_maker_mobile }}</option> 
                                                  @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="">Maker Delivery Date</label>
                                                <input type="text" autocomplete="off"  data-date-format="yyyy-mm-dd" data-date-end-date="{{ $order->its_add_order_delivery_date }}" class="form-control datepicker maker_delivery_date"  name="maker_delivery_date" required  placeholder="Maker Delivery Date">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                            {{-- Maker Update Form  --}}
                            @if (isset($maker_slno))
                              <div class="modal fade" id="makerUpdateForOrderModal{{ $order->its_add_order_slno }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <form action="{{ route('branch.OrderReport.maker-update-for-order') }}" method="get" id="makerUpdateForOrder">
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
                                          
                                            <div class="col-md-6 ">
                                              <label>Maker Name</label>
                                                <select class="form-control its_maker_slno select2" name="its_maker_slno" required>
                                                  <option value="">Select One</option>
                                                  @foreach ($makers_infom as $makers_info)
                                                    <option  {{ ($maker_slno->its_maker_order_maker_slno == $makers_info->its_maker_slno)? 'selected': '' }} value="{{ $makers_info->its_maker_slno }}">{{ $makers_info->its_maker_name }} / {{ $makers_info->its_maker_mobile }}</option> 
                                                  @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12">
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
                            @endif
                            {{-- Order Status Check  --}}
                            @php
                              $order_count = App\Models\IglTailorAddOrder::order_count($order->its_add_order_order_id);
                              $order_status_count = App\Models\IglTailorAddOrder::order_status_count($order->its_add_order_order_id, $order->its_add_order_status);
                            @endphp
                            @if(
                                $order_count->count_order == $order_status_count->count_status  && $order_count->its_add_order_status == 3
                                && $order_count->its_add_order_status == $order_status_count->its_add_order_status
                            )
                              {{ Session::forget('not_given_a_maker_for_complete') }}
                            
                            @else
                              {{ Session::put('not_given_a_maker_for_complete',$order->its_add_order_order_id) }}
                            @endif
                            {{-- Order Status Check  --}}
                        @endforeach
                     <tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- /.row -->
    </section>
    <div class="modal fade" id="changeOrderDeliveryDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('branch.OrderReport.delivery-date-change') }}" method="get" id="orderDateChange">
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
                        <button type="submit" class="btn btn-primary">Save</button>
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
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>

      $(function () {
          //Initialize Select2 Elements
          $('.select2').select2();
          // Initialize Date 
          $(".datepicker").datepicker({
              startDate: new Date(),
              autoclose: true,
          });
      })
      // Order Date Change
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
      // Maker Set For Order
      $('#makerSetForOrder').on('submit',function(e){
          let form = $(this);
          let url  = form.attr('action');
          let type = form.attr('method');
          let its_add_order_slno  = $('.its_add_order_slno').val();
          let its_add_product_name = $('.its_add_product_name').val();
          let its_add_order_id    = $('.its_add_order_id').val();
          let its_maker_slno      = $('.its_maker_slno').val();
          let maker_delivery_date = $('.maker_delivery_date').val();
          let _token = "{{ csrf_token() }}";

          $.ajax({
            type: type,
            url : url,
            data: { its_add_order_slno:its_add_order_slno,its_add_product_name:its_add_product_name, its_add_order_id:its_add_order_id, its_maker_slno:its_maker_slno, maker_delivery_date:maker_delivery_date, _token:_token},
            success: function (result){
                 Swal.fire(
                  "Successfully",
                  "Maker Set",
                  "success"
                )
                $('.its_maker_slno').val('');
                $('.maker_delivery_date').val('');
            }
          })
      });
      // Maker Update For Order
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

    @if(session()->has('change_success'))
      Swal.fire(
        "Successfully",
        "{{ session()->get('change_success') }}",
        "success"
      )
    @endif
    // Buttton Submit After Disabled
    $('form').submit(function() {
       $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection
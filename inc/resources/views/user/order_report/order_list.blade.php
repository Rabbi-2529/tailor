@extends('user.layout.master')
@section('order_report_class','menu-open')
@section('order_report_class_link','active')
@section('order_list','active')
@section('content')
    <section class="content-header"> 
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Order Report Lists </h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="accordion">
                  <input class="accordion__radio" type="radio" name="accordion-tabs" id="tab-one"/ checked>
                  <label class="accordion__label" for="tab-one">Received Orders
                      <span class="accordion-tab--status"></span>
                  </label>
                  <div class="accordion__content px-2">
                    <div class="card-body table-responsive p-0">
                      <table id="table1" class="display table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Receiver</th>
                            <th>Order ID</th>
                            <th>Receive Date</th>
                            <th>Delivery Date</th>
                            <th>Customer Name</th>
                            <th>Mobile</th>        
                          </tr>  
                        </thead>
                        <tbody>
                          @foreach ($recieves as $recieve)
                            <tr>
                              <td>{{ $loop->index+1 }}</td>
                              <td>
                                @if(isset($recieve->its_add_order_user_id))
                                  @php
                                    $user_id = $recieve->its_add_order_user_id;
                                    $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                                  @endphp
                                  {{ $user_info->UserDetailsUser->its_username }}			
                                @else
                                  Branch
                                @endif
                              </td>
                              <td>{{ $recieve->its_add_order_order_id }}</td>
                              <td>{{ $recieve->its_add_order_receive_date }}</td>
                              <td>{{ $recieve->its_add_order_delivery_date }}</td>
                              <td>{{ $recieve->customer_name->its_cus_name }}</td>
                              <td>{{ $recieve->customer_name->its_cus_mobile }}</td>
                            </tr>                                
                          @endforeach
                        </tbody>  
                      </table>
                    </div>
                  </div>
                  <input class="accordion__radio" type="radio" name="accordion-tabs" id="tab-two" />
                  <label class="accordion__label" for="tab-two">Processing Orders
                      <span class="accordion-tab--status"></span>
                  </label>
                  <div class="accordion__content px-2">
                    <div class="card-body table-responsive p-0">
                      <table id="table2" class="display table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Receiver</th>
                            <th>Order ID</th>
                            <th>Receive Date</th>
                            <th>Delivery Date</th>
                            <th>Customer Name</th>
                            <th>Mobile</th>   
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($processing as $process)
                              <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>
                                  @if(isset($process->its_add_order_user_id))
                                    @php
                                      $user_id = $process->its_add_order_user_id;
                                      $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                                    @endphp
                                    {{ $user_info->UserDetailsUser->its_username }}			
                                  @else
                                    Branch
                                  @endif
                                </td>
                                <td>{{ $process->its_add_order_order_id }}</td>
                                <td>{{ $process->its_add_order_receive_date }}</td>
                                <td>{{ $process->its_add_order_delivery_date }}</td>
                                <td>{{ $process->customer_name->its_cus_name }}</td>
                                <td>{{ $process->customer_name->its_cus_mobile }}</td>
                              </tr>                                
                            @endforeach 
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <input class="accordion__radio" type="radio" name="accordion-tabs" id="tab-three"/>
                  <label class="accordion__label" for="tab-three">Completed Orders
                    <span class="accordion-tab--status"></span>
                  </label>
                  <div class="accordion__content px-2">
                      <div class="card-body table-responsive p-0">
                        <table id="table3" class="display table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>SL</th>
                              <th>Receiver</th>
                              <th>Order ID</th>
                              <th>Receive Date</th>
                              <th>Delivery Date</th>
                              <th>Customer Name</th>
                              <th>Mobile</th>
                              <th>Due</th>
                              <th>Delivery Order</th>
                            </tr>
                          </thead>
                          <tbody id="completeRealDateShow">
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
                                    <a  onclick='complete_status("{{ $complete->its_add_order_order_id }}")'  id="complete_button{{ $complete->its_add_order_order_id }}" class="btn btn-success btn-sm">
                                      Yes
                                    </a>
                                 </td>
                              </tr>                                
                              @endforeach 
                          </tbody>
                        </table>
                      </div>
                  </div>
                  <input class="accordion__radio" type="radio" name="accordion-tabs" id="tab-four"/>
                  <label class="accordion__label" for="tab-four">Delivery Orders
                    <span class="accordion-tab--status"></span>
                  </label>
                  <div class="accordion__content px-2">
                    <div class="card-body p-0">
                        <div class="col-12 pb-3">
                          <form  action="{{ route('user.OrderReport.search-delivery-order') }}" method="POST" class="form-row" id="search_delivery_order">
                            @csrf
                              <div class="col-sm-4 col-lg-2 pl-0 pb-2">
                                <input type="text" name="start_date" value="{{ $start_date }}" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Delivery Date"  class="form-control datepicker" required>
                              </div>
                              <div class="col-sm-4 col-lg-2 pl-0 pb-2">
                                <input type="text" name="end_date" value="{{ $end_date }}" autocomplete="off" data-date-format="yyyy-mm-dd"  placeholder="Delivery Date"  class="form-control datepicker" required>
                              </div>
                              <div>
                                <button class="btn btn-success">Submit</button>
                              </div>
                          </form>
                        </div>
                        <div class="table-responsive p-0">
                            <table id="table4" class="display table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>SL</th>
                                  <th>Receiver</th>
                                  <th>Order ID</th>
                                  <th>Receive Date</th>
                                  <th>Delivery Date</th>
                                  <th>Customer Name</th>
                                  <th>Mobile</th>  
                                </tr>
                              </thead>
                              <tbody id="searchDeliveryOrderShow">
                                @foreach ($deliveries as $delivery)
                                  <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>
                                       @if(isset($delivery->its_add_order_user_id))
                                          @php
                                            $user_id = $delivery->its_add_order_user_id;
                                            $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                                          @endphp
                                          {{ $user_info->UserDetailsUser->its_username }}			
                                        @else
                                          Branch
                                        @endif
                                    </td>
                                    <td>{{ $delivery->its_add_order_order_id }}</td>
                                    <td>{{ $delivery->its_add_order_receive_date }}</td>
                                    <td>{{ $delivery->its_add_order_delivery_date }}</td>
                                    <td>{{ $delivery->customer_name->its_cus_name }}</td>
                                    <td>{{ $delivery->customer_name->its_cus_mobile }}</td>
                                  </tr>                                
                                @endforeach 
                              </tbody>
                            </table>
                        </div>  
                      </div>
                    </div>
                  </div>
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
  <link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">  
@endsection
@section('custom_script')
  <script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
  <script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/datatable/js/dataTables.rowReorder.min.js') }}"></script>
  <script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
  <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
  <script>

    $(function () {
    //Date range picker
        $('.datepicker').datepicker({
            daysOfWeekHighlighted: "7",
            autoclose: true,
            todayHighlight: true,
        });
    })

    $(document).ready(function() {
        $('table.display').DataTable();
    });
    // Order Delivery Confirm Script
    function complete_status(order_id)
    {
       let url = "{{ route('user.OrderReport.delivery-status') }}";
       let complete_button = document.getElementById("complete_button"+order_id);
       
       complete_button.style.display = "none";
       
        $.ajax({  
            type: "GET",
            url: url,
            data: { order_id: order_id},
            success: function (result) {
                $('#completeRealDateShow').html(result);
                Swal.fire(
                    "Successfully!",
                    "Order Delivery",
                    "success"
                )
                return realDataDeliveryOrder();
            }
        });
    }
    // Order Delivery Confirm Script
    $('#search_delivery_order').on('submit',function(e)
    {
        e.preventDefault();
        let form  = $(this);
        let url   =  form.attr('action');
        let type  =  form.attr('method');
        let data  =  form.serialize();

         $.ajax({  
            type: type,
            url: url,
            data: data,
            success: function (result) {
               $('#searchDeliveryOrderShow').html(result);
            }
        });
    });
    // Order Delivery Confirm Script
    function realDataDeliveryOrder()
    {
       let url = "{{ route('user.OrderReport.real-data-delivery-order') }}";

       $.ajax({  
            type: "GET",
            url: url,
            success: function (result) {
               $('#searchDeliveryOrderShow').html(result);
            }
        });
    }
  </script>
@endsection
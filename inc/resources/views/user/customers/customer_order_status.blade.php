@extends('user.layout.master')
@section('customer_class','menu-open')
@section('customer_class_link','active')
@section('all_customer','active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Customer</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('user.customer.all-customer') }}">Customer List</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
     <section class="content">
        <div class="row" id="allcustomer">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer Name: {{ $customer_info->its_cus_name }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>View</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($customer_order_ids as $customer_order_id)
                    @php
                        $total_order = App\Models\IglTailorAddOrder::where('its_add_order_order_id',$customer_order_id->its_add_order_order_id)->count();
                        
                        $receive_order = App\Models\IglTailorAddOrder::where('its_add_order_order_id',$customer_order_id->its_add_order_order_id)
                                                                      ->where('its_add_order_status',2)
                                                                      ->count();
                        $processing_order = App\Models\IglTailorAddOrder::where('its_add_order_order_id',$customer_order_id->its_add_order_order_id)
                                                                      ->where('its_add_order_status',3)
                                                                      ->count();
                        $complete_order = App\Models\IglTailorAddOrder::where('its_add_order_order_id',$customer_order_id->its_add_order_order_id)
                                                                      ->where('its_add_order_status',4)
                                                                      ->count();
                        $delivery_order = App\Models\IglTailorAddOrder::where('its_add_order_order_id',$customer_order_id->its_add_order_order_id)
                                                                      ->where('its_add_order_status',5)
                                                                      ->count();
                     @endphp
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $customer_order_id->its_add_order_order_id }}</td>
                        <td>
                           
                            @if ($total_order == $receive_order)
                                Receive     
                            @elseif ($total_order == $processing_order) 
                                Processing...
                            @elseif ($total_order == $complete_order) 
                                Complete
                            @elseif ($total_order == $delivery_order) 
                                Delivered
                             @else
                                Pending...
                            @endif    
                            
                        </td>
                        <td class="text-right">
                          @if(isset($customer_order_id->order_total_amount))
                            {{ $customer_order_id->order_total_amount->acc_debit }}<span>.00</span>
                          @else
                            <span>0.00</span>
                          @endif
                        </td>
                        <td class="text-center">
                          <a href="{{ route('user.customer.customer-order-details',base64_encode($customer_order_id->its_add_order_order_id)) }}">
                              <i class="fas fa-eye"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
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
          var table = $('#example1').DataTable( {
          rowReorder: {
              selector: 'td:nth-child(2)'
          },
          responsive: true
        });
      });
      </script>
@endsection
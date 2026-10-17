@extends('branch.layout.master')
@section('worker_class','menu-open')
@section('worker_class_link','active')
@section('statement','active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Maker</h1>
            </div>
             <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a  href="{{ route('branch.worker.statement-view', base64_encode($maker_info->its_maker_slno) ) }}">
                        Maker Statments View
                    </a>
                </li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Maker Payment Statements Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <div class="col-12 pb-3 row">
                            <div class="col-7 pl-0">
                                <div>Maker Name : {{ $maker_info->its_maker_name }}</div>         
                            </div>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order Receive Date</th>
                                    <th>Product Name</th>
                                    <th class="text-right">Making Cost</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Credit</th>
                                </tr>
                            </thead>
                            <tbody id="maker_data">
                                @php
                                    $shirt_amount      = 0;
                                    $pant_amount       = 0;
                                    $blazer_amount     = 0;
                                    $panjabi_amount    = 0;
                                    $payjama_amount    = 0;
                                    $safari_amount     = 0;
                                    $photua_amount     = 0;
                                    $mojib_cort_amount = 0;
                                    $kable_amount      = 0;
                                    $koti_amount       = 0;

                                    $total_qty = 0;
                                    $total_amount = 0;
                                    $sl = 0;
                                @endphp
                                @foreach ($maker_order_infor as $maker_order_info)
                                    <tr>
                                        <td>{{  ++$sl }}</td>
                                        <td>{{ $maker_order_info->its_add_order_receive_date }}</td>
                                        <td>
                                            {{ $maker_order_info->its_add_product_name }}
                                        </td>
                                        <td class="text-right">
                                            {{ $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                        </td>
                                        <td class="text-right">
                                            {{ $maker_order_info->its_add_product_quantity }}
                                            @php
                                                $total_qty += $maker_order_info->its_add_product_quantity;
                                            @endphp
                                        </td>
                                        <td class="text-right">
                                            @if ($maker_order_info->its_add_product_name == 'Shirt')

                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $shirt_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Pant')
                                            
                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $pant_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount 
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Blazer')
                                            
                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $blazer_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Panjabi')
                                            
                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $panjabi_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount 
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Payjama')
                                            
                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $payjama_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Safari')
                                            
                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $safari_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Photua')
                                            
                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $photua_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Mojib Cort')
                                            
                                                {{ $maker_order_info->its_add_product_quantity * $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $mojib_cort_amount += $maker_order_info->its_add_product_quantity * $maker_order_info->its_add_maker_cost_amount
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Kable')
                                            
                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $kable_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount
                                                @endphp
                                            @elseif($maker_order_info->its_add_product_name == 'Koti')
                                            
                                                {{ $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount }}<span>.00</span>
                                                @php
                                                    $koti_amount += $maker_order_info->its_add_product_quantity *  $maker_order_info->its_add_maker_cost_amount
                                                @endphp
                                            @endif
                                        </td>
                                        
                                        @php 
                                            $total_amount = $shirt_amount + $pant_amount + $blazer_amount + $panjabi_amount 
                                                                            + $payjama_amount + $safari_amount + $photua_amount 
                                                                            + $mojib_cort_amount  + $kable_amount + $koti_amount                  
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="font-weight-bold">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">Total</td>
                                    <td class="text-right">{{ $total_qty }}</td>
                                    <td class="text-right">{{  $total_amount}}<span>.00</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom_style')
<link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">  
<link rel="stylesheet" href="{{ asset('assets/datatable/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.dataTables.min.css') }}">
@endsection
@section('custom_script')
<script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
<script>
    
    $(document).ready(function() {
        let table = $('#example1').DataTable( {
          responsive: true
        });
    });    
    
    $(function () {
        $(".datepicker").datepicker();
    })

    // $(document).on('submit','#montly-salary-show',function(e){
    //     e.preventDefault();
    //     let form = $(this);
    //     let url  = form.attr('action');
    //     let type  = form.attr('method');
    //     let data = form.serialize();

    //     $.ajax({
    //         url: url,
    //         type: type,
    //         data: data,
    //         dataType:'json',
    //         success: function(result){
    //             $('#maker_data').val(result);
    //         },
    //     });
    // });

    

    
</script>
@endsection

@extends('branch.layout.master')
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid" id="buy">
      <div class="row">
        <!-- left column -->
        <div class="col-12 pt-4">
          <!-- general form elements -->
          <div class="card">
            <div class="card-header" style="margin: 0 auto">
              <h3 class="card-title">Invoice</h3>
            </div>
            <div class="card-body">
                <div class="row pb-4">
                    <div class="col-sm-7 col-md-9 col-12">
                        <table>
                            <tr>
                                <td class="font-weight-bold">Customer Name </td>
                                <td><span class="px-2">:</span>{{ $customer_info->its_cus_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Address      </td>
                                <td><span class="px-2">:</span>{{ $customer_info->its_cus_address }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Sale By   </td>
                                <td><span class="px-2">:</span>Branch</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-5 col-md-3 col-12"> 
                        <table>
                            <tr>
                                <td class="font-weight-bold">Invoice No</td>
                                <td><span class="px-2">:</span>{{ Session::get('sale_invoice_no') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Mobile      </td>
                                <td><span class="px-2">:</span>{{ $customer_info->its_cus_mobile }}</td>
                            </tr>
                            
                        </table>  
                    </div>
                </div>
                <div class="table-responsive">
                    <table  class="table  table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th class="text-right">Price</th>
                                <th class="text-right" style="width: 15%">Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="product_list">
                            @php
                                $sub_amount = 0;
                            @endphp
                            @foreach ($temp_pro_sales as $product)
                                @php
                                    $sub_amount += $product->its_total_price;
                                @endphp
                                <tr>
                                    <td style="padding: 5px 15px">{{ $loop->index+1 }}</td>
                                    <td>{{ $product->product->productNamepro->its_proname_product_name }}</td>
                                    <td>{{ $product->its_qty }}</td>
                                    <td class="text-right">{{ $product->its_price }}<span>.00</span></td>
                                    <td class="text-right">{{ $product->its_total_price  }}<span>.00</span></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Total Amount</td>
                                <td class="text-right">
                                    {{ $sub_amount  }}<span>.00</span>
                                </td>
                            </tr>
                            <tr class="font-weight-bold">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Discount</td>
                                <td class="text-right">
                                    @if ($discount != "")
                                        {{ $discount }}<span>.00</span>
                                    @else
                                        <span>0.00</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="font-weight-bold">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Net Payment Amount</td>
                                <td class="text-right" >{{ ($total_amount != "")? $total_amount : $sub_amount }}<span>.00</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if (isset($discount))
                @php
                    $total_amount = $sub_amount - $discount;
                @endphp
                <input type="hidden" id="total_amount"   value="{{  $total_amount }}">
            @else
                <input type="hidden" id="total_amount"   value="{{  $sub_amount }}">
            @endif
            
            <input type="hidden" id="discount"     value="{{ ($discount != "")? $discount: 0  }}">
            <div class="card-footer col-12">
                <button type="submit" id="invoice_print" class="btn btn-success float-right">Finish And Print</button>
                <a href="{{ route('branch.sale.sale-product') }}" id="invoice_edit" class="btn btn-danger float-right" style="margin: 0px 10px">Edit</a>
            </div>
              
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('custom_style')
<link rel="stylesheet" href="{{ asset('assets/datatable/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.dataTables.min.css') }}">
<style>
    i.fas.fa-plus {
      padding: 10px 6px;
  }
  .table th, .table td {
    border-left: 0px;
    border-right: 0px;
  }
  .form-control::-webkit-inner-spin-button,
    .form-control::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }
</style>
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
   
     
    // Invoice Create For Sale 
    $('#invoice_print').on('click',function(e)
    {   
        e.preventDefault();

        let invoice_no  = "{{ Session::get('sale_invoice_no') }}";
        let customer_id  = "{{ $customer_info->its_cus_slno }}";
        let total_amount = parseInt($('#total_amount').val());
        let discount     = parseInt($('#discount').val());

        let route = "{{ route('branch.sale.sale-product-invoice-insert') }}"

        $.ajax({  
            type: 'get',
            url : route,
            data: {invoice_no:invoice_no,customer_id:customer_id,total_amount:total_amount,discount:discount},
            success: function (result) {
                
                window.open("{{ route('branch.sale.sale-invoice-generate', base64_encode(Session::get('sale_invoice_no'))) }}", "PopupWindow", "width=800,height=600,scrollbars=yes,resizable=no");
                window.location.href = "{{ route('branch.sale.sale-product') }}";
            }
        });
    });

    // Form Submit After Button Disabled
    $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection
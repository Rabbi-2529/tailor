@extends('user.layout.master')
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
                    <div class="col-sm-9 col-12">
                        <table>
                            <tr>
                                <td class="font-weight-bold">Suplier Name </td>
                                <td><span class="px-2">:</span>{{ $supplier_info->its_sup_name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Address      </td>
                                <td><span class="px-2">:</span>{{ $supplier_info->its_sup_address }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Bought By   </td>
                                <td><span class="px-2">:</span>{{ Auth::User()->its_username }} </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-3 pl-lg-5  col-12"> 
                        <table>
                            <tr>
                                <td class="font-weight-bold">Invoice No</td>
                                <td><span class="px-2">:</span>{{ Session::get('invoice_no') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Mobile      </td>
                                <td><span class="px-2">:</span>{{ $supplier_info->its_sup_mobile }}</td>
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
                                <th class="text-right">Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="product_list">
                            @php
                                $total_amount = 0;
                            @endphp
                            @foreach ($temp_pro_buy as $product)
                                @php
                                    $total_amount += $product->its_total_price;
                                @endphp
                                <tr>
                                    <td style="padding: 5px 15px">{{ $loop->index+1 }}</td>
                                    <td>{{ $product->product->productNamepro->its_proname_product_name }}</td>
                                    <td>{{ $product->its_qty }}</td>
                                    <td class="text-right">{{ $product->its_price }}<span>.00</span></td>
                                    <td class="text-right">{{ $product->its_total_price  }}<span>.00</span></td>
                                </tr>
                            @endforeach
                            <tr class="font-weight-bold">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Total</td>
                                <td class="text-right" id="total_amount">{{ $total_amount }}<span>.00</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer col-12">
                <button type="submit" id="invoice_print" class="btn btn-success float-right">Finish And Print</button>
                <a href="{{ route('user.buy.buy-product') }}" id="invoice_edit" class="btn btn-danger float-right" style="margin: 0px 10px">Edit</a>
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
   //  Invoice Print
    $('#invoice_print').on('click',function(e)
    {  
        e.preventDefault();

        let invoice_print = document.getElementById("invoice_print");
        let invoice_edit  = document.getElementById("invoice_edit");
        let url = "{{ route('user.buy.buy-product-invoice-insert') }}"

        $.ajax({  
            type: 'get',
            url : url,
            success: function (result) {
                if(result = 'success')
                {
                    invoice_print.style.display = "none";
                    invoice_edit.style.display = "none";
                    
                    window.print();

                    invoice_print.style.display = "block";
                    invoice_edit.style.display = "block";

                    window.location.href = "{{ url('user/buy/buy-product') }}";
                }
            }
        });
    });

    // Form Submit After Button Disabled
    $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection
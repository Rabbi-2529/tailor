@extends('branch.layout.master')
@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid" id="buy_product_css">
      <div class="row">
        <!-- left column -->
        <div class="col-12 pt-4">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Product Buy</h3>
            </div>
              <form action="{{ route('branch.buy.buy-product-invoice') }}" method="POST" id="buy-product-invoice">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1" class="font-weight-bold">Supplier Name <span style="color:red">*</span></label>
                            <select name="supplier_id" onchange="supplier_select(this.value)" class="form-control select2" required>
                                  <option value="">Select One</option>
                                  @foreach ($suppliers as $supplier)
                                    <option {{  ( Session::get('supplier_id')  == $supplier->its_sup_slno) ? 'selected' : '' }} value="{{ $supplier->its_sup_slno }}">
                                      {{ $supplier->its_sup_name }} ({{ ($supplier->its_sup_status == 1)?  "Local" : "Global"}})
                                    </option>
                                  @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1" class="font-weight-bold">Invoice No <span style="color:red">*</span></label>
                            <input type="text" name="invoice_no" value="{{ (Session::has('invoice_no'))? Session::get('invoice_no'): ''  }}" class="form-control" autocomplete="off" placeholder="Enter Invoice No" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1" class="font-weight-bold">Issue Date <span style="color:red">*</span></label>
                            <input type="text" name="issue_date" value="{{ (Session::has('issue_date'))? Session::get('issue_date'): $current_date  }}" data-date-end-date="{{ $current_date }}" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control datepicker" placeholder="Enter Issue Date" required>
                        </div>
                    </div>
                    <div>
                        <div class="">
                          <div class="table-responsive">
                              <table id="example1" class="table table-striped table-bordered table_responsive_css">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>A. Stock</th>
                                        <th class="text-right">Buy Price</th>
                                        <th style="width: 15%">Purchase</th>
                                    </tr>
                                </thead>
                                <tbody id="product_list">
                                    @foreach ($product_lists as $product)
                                        @php
                                            $total_qtys = App\Models\IglTailorInventoryDetails::total_quantity($product->its_inv_pro_slno);
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $product->productNamepro->its_proname_product_name }}</td>
                                            <td>{{ $product->productGrouppro->its_inv_progrp_name }}</td>
                                            <td>{{ $product->productTypepro->its_protype_name }}</td>
                                            <td class="text-center">
                                                @if (count($total_qtys) > 0)
                                                  @foreach ($total_qtys as $total_qty)
                                                    @if ($total_qty->buy_qty != "")
                                                      @php
                                                          $total_qty = $total_qty->buy_qty - $total_qty->sell_qty
                                                      @endphp
                                                        {{ $total_qty }}
                                                    @else
                                                        0
                                                    @endif
                                                  @endforeach
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td class="text-right">
                                              {{ $product->its_inv_pro_buy_price }}<span>.00</span>
                                              <input type="hidden" name="product_price" id="product_price{{ $product->its_inv_pro_slno }}" value="{{ $product->its_inv_pro_buy_price }}" class="form-control">
                                            </td>
                                            <td class="text-right">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <input type="text" autocomplete="off" name="product_quantity" id="product_qty{{ $product->its_inv_pro_slno }}" class="form-control" placeholder="Qty">
                                                    </div>
                                                    <div class="col-4 p-0">
                                                        <button type="button" onclick="addToCart({{ $product->its_inv_pro_slno }})"   class="btn btn-success btn-sm">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    <div class="pt-3">
                        <h5><i class="fa fa-shopping-cart pr-2"></i> Buy Invoice</h5> 
                        <div class="table-responsive  p-2" style="border:1px solid grey">
                          <table  class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>SL</th>
                                      <th>Name</th>
                                      <th>Qty</th>
                                      <th>Price</th>
                                      <th class="text-right">Total Price</th>
                                      <th style="width: 20%">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="product_buy_list">

                              </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success float-right mx-2">Continue</button>
                  <button type="button" id="invoice_close" class="btn btn-danger float-right ">Close</button>
                </div>
              </form>  
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
<script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
    $(document).ready(function() {
        let table = $('#example1').DataTable( {
        responsive: true
      });
    });
  
    $(function () {
        // Initial Select
        $('.select2').select2();
        // Initial Datepicker
        $(".datepicker").datepicker({
            autoclose: true,
        });
        // Supplier Function Call
        supplier_select("{{ Session::get('supplier_id') }}")
        // Add To Cart Function Call
        cart_product_show()
    })
    // Product Add To Cart Check
    $('#buy-product-invoice').on('submit',function(e)
    {
        let addToCartCheck = $('#addToCartCheck').val();

        if( addToCartCheck == 0){
           e.preventDefault();
           alert('Product Add To Cart');
        }
    });

  // Supplier Product Show Script
    function supplier_select(supplier_id) 
    {
        let url = "{{ route('branch.buy.supplier-product-show') }}";
        
        $.ajax({  
            type: "GET",
            url: url,
            data: { supplier_id: supplier_id},
            success: function (result) {
              $("#product_list").html(result);
            }
        });
    }
  // Product Add To Cart
    function addToCart(product_id)
    {
        let product_price = $('#product_price'+product_id).val();
        let product_qty = $('#product_qty'+product_id).val();
        
        let url = "{{ route('branch.buy.add-to-cart') }}";

        if(product_qty == ""){
          alert('Product Quantity Required')
          return false;
        }


        $.ajax({  
              type: "GET",
              url: url,
              data: { product_id: product_id, product_price:product_price, product_qty: product_qty},
              success: function (result) {
                return cart_product_show();
              }
        });
    }
  // Cart Product Show
  function cart_product_show()
    {   
        let url = "{{ route('branch.buy.cart-product-show') }}";

        $.ajax({  
              type: "get",
              url: url,
              success: function (result) {
                $("#product_buy_list").html(result);
              }
        });
    }
  // Cart Product Delete
    function delete_item(route)
    {   
        let _token=$("#_token").val();
      
        // e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    // redirect url
                    $.ajax({  
                        type: "GET",
                        url: route,
                        data: { _token:_token},
                        success: function (result) {
                           cart_product_show();
                        }
                    });
                } 
            });
    }
  // Invoice Close 
    $('#invoice_close').on('click',function()
    {
        let url = "{{ route('branch.buy.buy-product-invoice-close') }}";

        $.ajax({  
              type: "get",
              url: url,
              success: function (result) {
                window.location.href = "{{ url('branch/buy/buy-product') }}";
              }
        });
    });

    @if(session()->has('alerady_insert'))
        Swal.fire(
            "Opps!",
            "{{ session()->get('alerady_insert') }}",
            "error",
        )
    @endif
    @if(session()->has('invoice_close'))
        Swal.fire(
            "Successfully",
            "{{ session()->get('invoice_close') }}",
            "success",
        )
    @endif

    // Form Submit After Button Disabled
    $('form').submit(function() {
          $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection
@extends('user.layout.master')
@section('content')  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid" id="sale_product_css">
      <div class="row">
        <!-- left column -->
        <div class="col-12 pt-4">
          <!-- general form elements -->
          <div class="card card-primary">
              <div class="card-header row  m-0">
                <div class="col-4 col-sm-6">
                  <h3 class="card-title">Product Sale</h3>
                </div>
              </div>
              <form action="{{ route('user.sale.sale-product-invoice') }}" method="POST" id="sale-product-invoice">
                @csrf
                <div class="card-body">
                    <div class="row col-12"> 
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Select Customer <span style="color:red">*</span></label>
                                <select class="form-control select2"  name="customer_id" required>
                                    <option value="">Select One</option>
                                    @foreach ($customers as $cus)
                                      @php
                                          $bran = Auth::user()->UserDetails->its_user_bran_id;
                                          $branch_ids = explode(',',$cus->its_cus_bran_id); 
                                      @endphp
                                      @if (in_array($bran, $branch_ids))
                                        <option {{  ( Session::get('sale_customer_id')  == $cus->its_cus_slno) ? 'selected' : '' }}  value="{{ $cus->its_cus_slno }}">
                                            {{ $cus->its_cus_name }} / {{ $cus->its_cus_mobile }}
                                        </option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Select Group</label>
                                <select class="form-control select2" id="pro_group_id" name="group_id" onchange="group_name(this.value)">
                                    <option value="">Select One</option>
                                    @foreach ($pro_groups as $pro_group)
                                        <option {{  ( Session::get('sale_group_id')  == $pro_group->its_inv_progrp_slno) ? 'selected' : '' }} value="{{ $pro_group->its_inv_progrp_slno }}">
                                            {{ $pro_group->its_inv_progrp_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Select Type</label>
                                <select class="form-control select2" id="pro_type_name" name="type_id">

                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 pt-sm-4 pb-2" style="margin-top: 10px;">
                            <button type="button" id="search_product" class="btn btn-success">Search</button>
                        </div>
                    </div>
                    {{-- Product Table Start --}}
                    <div class=" table-responsive">
                      <table id="example1" class="table table-bordered table-striped table_responsive_css">
                          <thead>
                              <tr>
                                  <th>SL</th>
                                  <th>Name</th>
                                  <th>Group</th>
                                  <th>Type</th>
                                  <th>A. Stock</th>
                                  <th class="text-right">Price</th>
                                  <th style="width: 15%">Sale</th>
                              </tr>
                          </thead>
                          <tbody id="product_search_show">
                              @php
                                $sl= 0;
                              @endphp
                              @foreach ($products as $pro)
                                @php
                                    $total_qtys = App\Models\IglTailorInventoryDetails::user_total_quantity($pro->its_inv_pro_slno);
                                @endphp
                                <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td>{{ $pro->productNamepro->its_proname_product_name }}</td>
                                    <td>{{ $pro->productGrouppro->its_inv_progrp_name }}</td>
                                    <td>{{ $pro->productTypepro->its_protype_name }}</td>
                                    <td class="text-center" id="available_qty{{ $pro->its_inv_pro_slno }}">
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
                                    <td id="price{{ $pro->its_inv_pro_slno }}"  class="text-right">{{ $pro->its_inv_pro_sell_price }}<span>.00</span></td>
                                    <td class="text-center">
                                      <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" autocomplete="off" name="qty" id="qty{{ $pro->its_inv_pro_slno }}" class="form-control"  placeholder="Qty" >
                                        </div>
                                        <div class="col-md-4 p-0">
                                            <button type="button" id="addToCart" data-id="{{ $pro->its_inv_pro_slno }}" class="btn btn-success btn-sm">
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
                    {{-- Product Table End --}}
                    {{-- Cart Table Start --}}
                    <div class="pt-3">
                        <h5><i class="fa fa-shopping-cart pr-2"></i> Sale Invoice</h5> 
                        <div class="table-responsive  p-2" style="border:1px solid grey">
                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-right" style="width: 20%">Amount</th>
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody  id="show-cart-content">

                                  </tbody>
                            </table>
                        </div>
                        <div class="card-footer  pr-0">
                          <button type="submit" class="btn btn-success float-right mx-2">Continue</button>
                          <!--<button type="button" id="invoice_close" class="btn btn-danger float-right ">Close</button>-->
                        </div>
                    </div>
                    {{-- Cart Table End --}}
                </div>
              </form>   
          </div>
        </div>
      </div>      
    </div>
  </section>
@endsection
@section('custom_style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.dataTables.min.css') }}">
<style>
    .form-control::-webkit-inner-spin-button,
    .form-control::-webkit-calendar-picker-indicator {
          display: none;
          -webkit-appearance: none;
    }
    .card-invoice{
      font-size: 1.1rem;
      font-weight: 400;
      margin: 0;
    }

</style>
@endsection
@section('custom_script')
<script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.rowReorder.min.js') }}"></script>
<script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        let table = $('#example1').DataTable( {
        responsive: true
      });
    });

    $(function () {
       $('.select2').select2();
       getCartProduct();
       group_name("{{ Session::get('sale_group_id') }}");
    })
    // Group Id Catch For Type Select
    function group_name(group_id)
    {
        let url = "{{ route('user.sale.type-name') }}";

        $.ajax({
            type: "get",
            url: url,
            data: { group_id: group_id },
            success: function (result) {
              $("#pro_type_name").html(result);
            }
        });
    }
    // Product Search 
    $('#search_product').on('click',function(){
        let pro_group_id  = $('#pro_group_id').val();
        let pro_type_id = $('#pro_type_name').val();

        let url =  "{{ route('user.sale.product-search') }}"
        
        if(pro_group_id == ""){
           alert ('Select Product Group Name');
           return false;
        }
        if(pro_type_id == ""){
           alert ('Select Product Type Name');
           return false;
        }

        $.ajax({
            type: "get",
            url: url,
            data: { pro_group_id: pro_group_id, pro_type_id: pro_type_id},
            success: function (result) {
              $('#product_search_show').html(result);
            }
        });
        
    });

    // Add To cart Script    
    $(document).on('click','#addToCart',function()
    {
        let product_id = $(this).data('id');
        let quantity = $('#qty'+product_id).val();
        let price = parseInt($('#price'+product_id).text());
        let url = "{{ route('user.sale.add-to-cart') }}"

        let available_qty = parseInt($('#available_qty'+product_id).text());

        if(available_qty == 0){
            alert('Product Not Available');
            return false;
        }
        else if(available_qty < quantity){
            alert('Product Not Available');
            return false;
        }

        if(quantity == ""){
            alert('Quantity Required');
            return false;
        }
        
        $.ajax({
            type: "get",
            url: url,
            data: { product_id: product_id, quantity: quantity, price: price},
            success: function (result) {
              return getCartProduct();
            }
        });

    });
    // Get Cart Product 
    function getCartProduct() {
      let route_url = "{{ route('user.sale.get-cart-content') }}";
      $.ajax({
          type: "GET",
          url: route_url,
          data: {},
          success: function (result) {
            $("#show-cart-content").html(result);
          }
      });
    }
    // Delete Cart Product 
    function delete_data(route){
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
                        console.log(result);
                          getCartProduct();
                        }
                    });
                } 
            });
    }
    // Discount Script 
    function cart_discount(discount_amount)
    { 
        let cart_subtotal = $('#cart_subtotal').val();
        let sub_amount = cart_subtotal - discount_amount;
        $('#cart_subtotal_td').html(sub_amount+".00");
        $('#total_amount').val(sub_amount);
    }
    // Product Add To Cart Check
    $('#sale-product-invoice').on('submit',function(e)
    {
        let addToCartCheck = $('#addToCartCheck').val();

        if( addToCartCheck == 0){
           e.preventDefault();
           alert('Product Add To Cart');
        }
    });
    // Invoice Close 
    $('#invoice_close').on('click',function()
    {
        let url = "{{ route('user.sale.sale-product-invoice-close') }}";

        $.ajax({  
              type: "get",
              url: url,
              success: function (result) {
                 window.location.href = "{{ route('user.sale.sale-product') }}";
              }
        });
    });
</script>
@endsection
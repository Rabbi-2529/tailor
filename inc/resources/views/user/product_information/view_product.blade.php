@extends('user.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('view_product','active')
@section('content')

  <section class="content">
      <div class="row">
        <div class="col-12 pt-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Supplier Name</th>
                  <th>Group Name</th>
                  <th>Type Name</th>
                  <th>Product Name</th>
                  <th>Buy</th>
                  <th>Sell</th>
                  <th>Registration Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($sl=0)
                  @foreach ($products as $pro)
                  <tr>
                      <td>{{ ++$sl }}</td>
                      <td>{{ $pro->productSupplierpro->its_sup_name }}</td>
                      <td>{{ $pro->productGrouppro->its_inv_progrp_name }}</td>
                      <td>{{ $pro->productTypepro->its_protype_name }}</td>
                      <td>{{ $pro->productNamepro->its_proname_product_name }}</td>
                      <td class="text-right">{{ $pro->its_inv_pro_buy_price }}<span>.00</span></td>
                      <td class="text-right">{{ $pro->its_inv_pro_sell_price }}<span>.00</span></td>
                      <td>{{ $pro->its_inv_pro_reg_date }}</td>
                      <td>
                          <a href="javascript:void(0);" data-toggle="modal" data-target="#product_edit" class="btn btn-info btn-sm" onclick="product_edit('{{ $pro->its_inv_pro_slno }}')">Edit</a>
                          <a href="javascript:void(0);" onclick="delete_data('{{ route('user.ProductInformation.product-delete',['id' => $pro->its_inv_pro_slno]) }}')" class="btn btn-danger btn-sm">Delete</a>
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

  {{ Form::open(['route' => ['user.ProductInformation.product-update'] , 'method' => 'post']) }}
      <div class="modal fade" id="product_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Product Update</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="product_edit_details">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </div>
      </div>
  {{ Form::close() }}

@endsection
@section('custom_style')
<link rel="stylesheet" href="{{ asset('assets/datatable/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.dataTables.min.css') }}">
@endsection
@section('custom_script')
{{-- <script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script> --}}
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
     
      // Supplier Id Catch For Group Name Show 
    function supplier_id_catch(supplier_id) 
    {
        let url = "{{ route('user.ProductInformation.supplierId-ajax-for-group') }}";
     
        $.ajax({  
          type: "GET",
          url: url,
          data: { supplier_id: supplier_id},
          success: function (result) {
             $("#group").html(result);
          }
        });
    }
    //  Product Group Id Catch For Product Type Name 
    function group_id_catch(group_id)
    {
        let url = "{{ route('user.ProductInformation.group-ajax-for-type') }}";
        $.ajax({  
            type: "GET",
            url: url,
            data: { group_id: group_id},
            success: function (result) {
              $("#pro_type_name").html(result);
            }
        });
    }
    //  Product Type Id Catch For Product Name 
    function type_id_catch(pro_type_id) 
    {
      let url = "{{ route('user.ProductInformation.type-ajax-for-pro-name') }}";
      
      $.ajax({  
        type: "GET",
        url: url,
        data: { pro_type_id: pro_type_id},
        success: function (result) {
           $("#pro_name").html(result);
        }
      });
    }
    
    function product_edit(pro_id) {
  
      let url = "{{ route('user.ProductInformation.product-edit-ajax') }}";
      var _token=$("#_token").val();
      $.ajax({  
        type: "GET",
        url: url,
        data: { pro_id: pro_id,_token:_token},
        success: function (result) {
          $("#product_edit_details").html(result);
          $("#product_edit").modal("show");
        }
      });
    }

    function delete_data(link){
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
                    window.location.replace(link);
                } 
            });
    }    
    @if(session()->has('pro_del'))
        Swal.fire(
            "Deleted!",
            "{{ session()->get('pro_del') }}",
            "success"
        )
    @endif
    @if ($errors->any())
      Swal.fire(
        "Oops...!",
        "Fill Up All Field",
        "error"
      )
    @endif
    @if(session()->has('pro_up'))
        Swal.fire(
            "Successfully!",
            "{{ session()->get('pro_up') }}",
            "success"
        )
    @endif
    @if(session()->has('already_insert'))
      Swal.fire(
        "Opps!",
        "{{ session()->get('already_insert') }}",
        "error"
      )
    @endif
</script>
@endsection
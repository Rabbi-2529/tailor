@extends('branch.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('view_location','active')
@section('content')
  <section class="content">
      <div class="row">
        <div class="col-12 pt-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product Location List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Group Name</th>
                  <th>Type Name</th>
                  <th>Product Name</th>
                  <th>Block</th>
                  <th>Self</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($sl=0)
                  @foreach ($locations as $location)
                  <tr>
                      <td>{{ ++$sl }}</td>
                      <td>{{ $location->groupInfo->its_inv_progrp_name }}</td>
                      <td>{{ $location->typeInfo->its_protype_name }}</td>
                      <td>{{ $location->productName->its_proname_product_name }}</td>
                      <td>{{ $location->its_inv_proloc_block }}</td>
                      <td>{{ $location->its_inv_proloc_self }}</td>
                      <td class="text-center">
                          <a href="javascript:void(0);" data-toggle="modal" data-target="#location_edit" class="btn btn-info btn-sm" onclick="location_edit('{{ $location->its_inv_proloc_slno }}')">Edit</a>
                          <a href="javascript:void(0);" onclick="delete_data('{{ route('branch.ProductInformation.location-delete',['id' => $location->its_inv_proloc_slno]) }}')" id="delete" class="btn btn-danger btn-sm delete">Delete</a>
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </section>

  {{ Form::open(['route' => ['branch.ProductInformation.location-update'] , 'method' => 'post']) }}
    <div class="modal fade" id="location_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Product Location Update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="location_edit_details">
            
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
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
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
      //Initialize Select2 Elements
      $('.select2').select2()
    })
    //  Product Group Id Catch For Product Type Name 
    function group_id_catch(group_id)
    {
        let url = "{{ route('branch.ProductInformation.group-ajax-for-type') }}";
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
      let url = "{{ route('branch.ProductInformation.type-ajax-for-pro-name') }}";
      
      $.ajax({  
        type: "GET",
        url: url,
        data: { pro_type_id: pro_type_id},
        success: function (result) {
           $("#pro_name").html(result);
        }
      });
    }
    function location_edit(loc_id) {
  
        let url = "{{ route('branch.ProductInformation.location-ajax') }}";
        let _token=$("#_token").val();
        
        $.ajax({  
          type: "GET",
          url: url,
          data: { loc_id: loc_id,_token:_token},
          success: function (result) {
            $("#location_edit_details").html(result);
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
   
    @if(session()->has('loc_del'))
        Swal.fire(
            "Deleted!",
            "{{ session()->get('loc_del') }}",
            "success"
        )
    @endif
    @if(session()->has('loc_update'))
        Swal.fire(
            "Updated!",
            "{{ session()->get('loc_update') }}",
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
    @if ($errors->any())
      Swal.fire(
        "Oops...!",
        "Fill Up All Field",
        "error"
      )
    @endif
</script>
@endsection
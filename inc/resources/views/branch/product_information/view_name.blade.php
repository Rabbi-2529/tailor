@extends('branch.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('view_name','active')
@section('content')
  <section class="content">
      <div class="row" id="group">
        <div class="col-12 pt-4">
          @if ($errors->any())
            <div class="alert alert-danger">
              Fill Up All Field 
            </div>
          @endif
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product Name List</h3>
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
                  <th>Product Des</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php($sl=0)
                  @foreach ($names as $name)
                  <tr>
                      <td>{{ ++$sl }}</td>
                      <td>{{ ($name->its_proname_sup_id != "")?  $name->supplier_name->its_sup_name : "" }}</td>
                      <td>{{ $name->groupName->its_inv_progrp_name }}</td>
                      <td>{{ $name->type_name->its_protype_name }}</td>
                      <td>{{ $name->its_proname_product_name }}</td>
                      <td>{{ $name->its_proname_product_desc }}</td>
                      <td class="text-center">
                          <a href="javascript:void(0);" data-toggle="modal" data-target="#name_edit" class="btn btn-info btn-sm" onclick="name_edit('{{ $name->its_proname_slno }}')">Edit</a>
                          <a href="javascript:void(0);" onclick="delete_data('{{ route('branch.ProductInformation.name-delete',['id' => $name->its_proname_slno]) }}')" class="btn btn-danger btn-sm">Delete</a>
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

  {{ Form::open(['route' => ['branch.ProductInformation.name-update'] , 'method' => 'post']) }}
  <div class="modal fade" id="name_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Product Name Update</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="name_edit_details">
              
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
    
    //  Group Id Catch For Product Type Name Script
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

    function name_edit(name_id) 
    {
      let url = "{{ route('branch.ProductInformation.name-ajax') }}";
      var _token=$("#_token").val();
      $.ajax({  
        type: "GET",
        url: url,
        data: { name_id: name_id,_token:_token},
        success: function (result) {
          $("#name_edit_details").html(result);
          $("#name_edit").modal("show");
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
        
    @if(session()->has('already_insert'))
        Swal.fire(
            "Opps!",
            "{{ session()->get('already_insert') }}",
            "error"
        )
    @endif
    @if(session()->has('pro_name_del'))
        Swal.fire(
            "Deleted!",
            "{{ session()->get('pro_name_del') }}",
            "success"
        )
    @endif
    @if(session()->has('name_update'))
        Swal.fire(
            "Successfully!",
            "{{ session()->get('name_update') }}",
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
</script>
@endsection
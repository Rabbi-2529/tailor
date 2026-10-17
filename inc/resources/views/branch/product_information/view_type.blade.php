@extends('branch.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('view_type','active')
@section('content')
  <section class="content">
    <div class="row" id="group">
      <div class="col-12 pt-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Product Type List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>SL</th>
                <th>Group Name</th>
                <th>Type Name</th>
                <th>Registration Date</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @php($sl=0)
                @foreach ($types as $type)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ $type->groupInfo->its_inv_progrp_name }}</td>
                    <td>{{ $type->its_protype_name }}</td>
                    <td>{{ $type->its_protype_date }}</td>
                    <td class="text-center">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#type_edit" class="btn btn-info btn-sm" onclick="type_edit('{{ $type->its_protype_slno }}')">Edit</a>
                        <a href="javascript:void(0);" onclick="delete_data('{{ route('branch.ProductInformation.type-delete',['id' => $type->its_protype_slno]) }}')" id="delete" class="btn btn-danger btn-sm delete">Delete</a>
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

  {{ Form::open(['route' => ['branch.ProductInformation.type-update'] , 'method' => 'post']) }}
  <div class="modal fade" id="type_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Product Type Update</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="type_edit_details">
              
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
<script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
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
    
    function type_edit(type_id) {

      let url = "{{ route('branch.ProductInformation.type-ajax') }}";
      var _token=$("#_token").val();
      $.ajax({  
        type: "GET",
        url: url,
        data: { type_id: type_id,_token:_token},
        success: function (result) {
          $("#type_edit_details").html(result);
          $("#type_edit").modal("show");
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
    @if ($errors->any())
      Swal.fire(
        "Oops...!",
        "Fill Up All Field",
        "error"
      )
    @endif
    @if(session()->has('type_del'))
        Swal.fire(
            "Deleted!",
            "{{ session()->get('type_del') }}",
            "success"
        )
    @endif
    @if(session()->has('type_up'))
        Swal.fire(
            "Successfully!",
            "{{ session()->get('type_up') }}",
            "success"
        )
    @endif
    @if(session()->has('already_insert'))
      Swal.fire(
        "Already!",
        "{{ session()->get('already_insert') }}",
        "error",
      )
    @endif
</script>
@endsection
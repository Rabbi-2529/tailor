@extends('user.layout.master')
@section('bank_details','menu-open')
@section('bank_details_link','active')
@section('bank_acc_list','active')
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
            <h3 class="card-title">Bank List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>SL</th>
                <th>Branch Name</th>
                <th>Bank Name</th>
                <th>Account No</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @php($sl=0)
                @foreach ($bankAccounts as $acc)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ $acc->its_bank_acc_branch_name }}</td>
                    <td>{{ $acc->bankName->its_bank_name }}</td>
                    <td>{{ $acc->its_bank_acc_acc_no }}</td>
                    <td class="text-center">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#bank_edit" class="btn btn-info btn-sm" onclick="bank_edit('{{ $acc->its_bank_acc_slno }}')">Edit</a>
                        <a href="javascript:void(0);" onclick="delete_data('{{ route('user.bank.bank-account-delete',['id' => $acc->its_bank_acc_slno]) }}')" id="delete" class="btn btn-danger btn-sm delete">Delete</a>
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

  {{ Form::open(['route' => ['user.bank.bank-update'] , 'method' => 'post']) }}
    <div class="modal fade" id="bank_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bank Update</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="bank_edit_details">
            
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
      
    function bank_edit(bank_id) {
  
      let url = "{{ route('user.bank.bank-edit-ajax') }}";
      var _token=$("#_token").val();
      $.ajax({  
        type: "GET",
        url: url,
        data: { bank_id: bank_id,_token:_token},
        success: function (result) {
          $("#bank_edit_details").html(result);
          $("#bank_edit").modal("show");
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
        
    @if(session()->has('acc_del'))
        Swal.fire(
            "Deleted!",
            "{{ session()->get('acc_del') }}",
            "success"
        )
    @endif
    @if(session()->has('bank_up'))
        Swal.fire(
            "Updated!",
            "{{ session()->get('bank_up') }}",
            "success"
        )
    @endif
    @if(session()->has('error_entry'))
        Swal.fire(
            "Already",
            "{{ session()->get('error_entry') }}",
            "error"
        )
    @endif

        
  </script>
@endsection
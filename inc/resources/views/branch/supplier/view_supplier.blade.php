@extends('branch.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('view_supplier','active')
@section('content')
    <section class="content">
        <div class="row">
          <div class="col-12 pt-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Supplier List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th class="text-right">Balance</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Bank Details</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                           <td>{{ $loop->index+1 }}</td>
                           <td>{{ $supplier->its_sup_name }}</td>
                           <td>{{ $supplier->its_sup_email }}</td>
                           <td>{{ $supplier->its_sup_mobile }}</td>
                           <td class="text-right">
                               @if($supplier->its_sup_due_balance != 0)
                                  {{ $supplier->its_sup_due_balance }}<span>.00</span>
                                @else
                                  0.00
                               @endif
                            </td>
                           <td>{{ $supplier->its_sup_address }}</td>
                           <td>
                              @if ($supplier->its_sup_status == 1)
                                Local
                              @else
                                Global
                              @endif
                           </td>
                           <td>
                              <a href="javascript:void(0);" data-toggle="modal" data-target="#bank_details"  onclick="bank_details('{{ base64_encode($supplier->its_sup_slno) }}')" class="btn btn-primary btn-sm">View</a>
                           </td>
                           <td>
                              <a href="{{ route('branch.supplier.update', base64_encode($supplier->its_sup_slno) ) }}" class="btn btn-info btn-sm">Edit</a>
                              <a href="javascript:void(0);" onclick="delete_data('{{ route('branch.supplier.delete',base64_encode($supplier->its_sup_slno) ) }}')" class="btn btn-danger btn-sm">Delete</a>
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

    {{-- Bank Details Modal --}}
    <div class="modal fade bd-example-modal-lg" id="bank_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bank Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body table-responsive" id="bank_details_show">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
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

    function bank_details(its_sup_slno) 
    {
        let url = "{{ route('branch.supplier.bank-details') }}";

        $.ajax({  
          type: "get",
          url: url,
          data: { its_sup_slno: its_sup_slno},
          success: function (result) {
             $('#bank_details_show').html(result)
          }
        });
    }

    function delete_data(supplier_slno)
    {
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
                    window.location.replace(supplier_slno);
                } 
            });
    }

    @if(session()->has('delete'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('delete') }}",
        "success",
      )
    @endif
</script>
@endsection
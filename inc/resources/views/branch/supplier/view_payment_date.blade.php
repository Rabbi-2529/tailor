@extends('branch.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('view_payment_date','active')
@section('content')
    <section class="content">
        <div class="row">
          <div class="col-12 pt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    Fill Up All Field 
                </div>
            @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Supplier Payment Date List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Payment Date</th>
                            <th>Supplier Name</th>
                            <th>Payment Type</th>
                            <th class="text-right">Payment Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_amount = 0;
                        @endphp
                        @foreach ($supplier_pay_dates as $supplier_pay)
                            @php
                                $total_amount += $supplier_pay->its_amount;
                            @endphp
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $supplier_pay->its_payment_date }}</td>
                                <td>{{ $supplier_pay->supplier_info->its_sup_name }}</td>
                                <td>{{ $supplier_pay->its_payment_type }}</td>
                                <td class="text-right">{{ $supplier_pay->its_amount }}<span>.00</span></td>
                                <td>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#payment_date" onclick="payment_date_update('{{ base64_encode($supplier_pay->its_sup_pay_date_id) }}')" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="javascript:void(0);" onclick="delete_data('{{ route('branch.supplier.payment-date-delete',base64_encode($supplier_pay->its_sup_pay_date_id) ) }}')" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>{{ $total_amount }}<span>.00</span></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
    </section>
    {{-- Payment Date Update Modal --}}
        <div class="modal fade bd-example-modal-md" id="payment_date" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <form action="{{ route('branch.supplier.payment-date-update') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment Date Update</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body table-responsive" id="pay_date_details">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
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

    // Payment Date Update Scripte
    function payment_date_update(sup_pay_date_id) 
    {
        let url = "{{ route('branch.supplier.payment-date-update-info') }}";

        $.ajax({  
          type: "get",
          url: url,
          data: { sup_pay_date_id: sup_pay_date_id},
          success: function (result) {
             $('#pay_date_details').html(result)
          }
        });
    }
    // Payment Date Delete Scripte
    function delete_data(sup_pay_date_id)
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
                    window.location.replace(sup_pay_date_id);
                } 
            });
    }

    @if(session()->has('payment_date_delete'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('payment_date_delete') }}",
        "success",
      )
    @endif
    @if(session()->has('payment_date_update'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('payment_date_update') }}",
        "success",
      )
    @endif
</script>
@endsection
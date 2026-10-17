@extends('branch.layout.master')
@section('customer_class','menu-open')
@section('customer_class_link','active')
@section('all_customer','active')
@section('content')
     <section class="content">
        <div class="row" id="allcustomer">
          <div class="col-12 pt-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Customers List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Reference</th>
                    <th>Order Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($customers as $customer)
                      @php
                          $bran = Auth::user()->BranchDetailsUser->its_branch_id;
                          $branch_ids = explode(',',$customer->its_cus_bran_id); 
                      @endphp
                      @if (in_array($bran,$branch_ids))
                        <tr>
                          <td>{{ $loop->index+1 }}</td>
                          <td>{{ $customer->its_cus_name }}</td>
                          <td>{{ $customer->its_cus_mobile }}</td>
                          <td>{{ $customer->its_cus_reference }}</td>
                          <td class="text-center">
                            <a href="{{ route('branch.customer.customer-order-status',base64_encode($customer->its_cus_slno)) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                          </td>
                        </tr>
                      @endif
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
<script>
      $(document).ready(function() {
        let table = $('#example1').DataTable( {
        responsive: true
      });
    });
</script>
@endsection
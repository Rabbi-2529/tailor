@extends('branch.layout.master')
@section('customer_class','menu-open')
@section('customer_class_link','active')
@section('view_statements','active')
@section('content')
    
     <section class="content">
        <div class="row">
          <div class="col-12 pt-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customers Payment Statements</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($customerIds as $customerId)
                        @php
                            $debit_amounts  =  App\Models\IglTailorAccount::total_debit_price($customerId->its_cus_slno);
                            $credit_amounts =  App\Models\IglTailorAccount::total_credit_price($customerId->its_cus_slno);
                            $balances       =  App\Models\IglTailorAccount::total_balance($customerId->its_cus_slno);

                            $bran = Auth::user()->BranchDetailsUser->its_branch_id;
                            $branch_ids = explode(',',$customerId->its_cus_bran_id);    
                        @endphp

                        @if (in_array($bran,$branch_ids))
                          <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $customerId->its_cus_name }}</td>
                            <td  class="text-right"> 
                                @foreach ($debit_amounts as $debit_amount)
                                  {{ $debit_amount->total_val }}<span>.00</span>
                                @endforeach
                            </td>
                            <td  class="text-right">
                                @if (count($credit_amounts) > 0)
                                    @foreach ($credit_amounts as $credit_amount)
                                      {{ $credit_amount->total_val }}<span>.00</span>
                                    @endforeach
                                @else
                                    <span>0.00</span>
                                @endif
                            </td>
                            <td  class="text-right">
                                @foreach ($balances as $balance)
                                    {{ $balance->total_credit - $balance->total_debit  }}<span>.00</span>
                                @endforeach
                            </td>
                            <td>
                              <a href="{{ route('branch.customer.view-statement-details',base64_encode($customerId->its_cus_slno)) }}">
                                  <i class="fas fa-eye"></i>
                              </a>
                            </td>
                          </tr>
                        @endif
                    @endforeach
                    <tfoot>
                      <tr class="font-weight-bold text-right">
                        <td></td>
                        <td>Total</td>
                        <td>
                          @foreach ($account_inform as $account_info)
                            {{ $account_info->total_debit }}<span>.00</span>
                          @endforeach
                        </td>
                        <td>
                          @foreach ($account_inform as $account_info)
                            {{ $account_info->total_credit }}<span>.00</span>
                          @endforeach
                        </td>
                        <td>
                          @foreach ($account_inform as $account_info)
                            {{ $account_info->total_credit - $account_info->total_debit  }}<span>.00</span>
                          @endforeach
                        </td>
                        <td></td>
                      </tr>
                  </tfoot>
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
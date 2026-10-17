@extends('user.layout.master')
@section('bank_details','menu-open')
@section('bank_details_link','active')
@section('bank_statement','active')
@section('content')
    <section class="content">
        <div class="row">
          <div class="col-12 pt-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bank Statement</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Bank Name</th>
                            <th>Account No</th>
                            <th class="text-right">Balance</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_balance = 0;
                        @endphp
                        @foreach ($bank_accounts as $bank_account)
                            @php
                                $balance_amounts =  App\Models\IglTailorBankTransaction::bank_balance($bank_account->its_bank_acc_bank_name);
                            @endphp
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $bank_account->bankName->its_bank_name }} ({{ $bank_account->its_bank_acc_branch_name }})</td>
                                <td>{{ $bank_account->its_bank_acc_acc_no }}</td>
                                <td class="text-right">
                                    @if (count($balance_amounts) > 0)
                                        @foreach ($balance_amounts as $balance_amount)
                                            @php
                                                $total_balance +=$balance_amount->credit_amount - $balance_amount->debit_amount
                                            @endphp
                                            {{ $balance_amount->credit_amount - $balance_amount->debit_amount }}<span>.00</span>    
                                        @endforeach
                                    @else
                                        <span>0.00</span>   
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user.bank.bank_statement_details',base64_encode($bank_account->its_bank_acc_bank_name)) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right">
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>{{ $total_balance }}<span>.00</span></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
    </section>
    
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
</script>
@endsection

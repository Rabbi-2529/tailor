@extends('user.layout.master')
@section('bank_details','menu-open')
@section('bank_details_link','active')
@section('bank_statement','active')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Bank Statement Details</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('user.bank.bank-statement') }}">View Bank Statement</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <span class="pr-2"> Branch Name: </span><span class="font-weight-bold">{{ $bank_info->its_bank_acc_branch_name }}</span>,
                    <span class="pr-2"> Bank Name:   </span><span class="font-weight-bold">{{ $bank_info->bankName->its_bank_name }}</span>,
                    <span class="pr-2"> Account No:  </span><span class="font-weight-bold">{{ $bank_info->its_bank_acc_acc_no }}</span>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th class="text-right">Debit</th>
                            <th class="text-right">Credit</th>
                            <th class="text-right">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_debit = 0;
                            $total_credit = 0;
                            $total_balance = 0;
                        @endphp
                        @foreach ($statement_details as $statement_detail)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $statement_detail->its_bank_tran_date }}</td>
                                <td>
                                  {{ $statement_detail->its_bank_tran_desc }}
                                  @if ($statement_detail->its_bank_tran_credit > 0 && $statement_detail->its_bank_tran_ref == 1)
                                      (Credit from Customer)
                                  @elseif($statement_detail->its_bank_tran_credit > 0 && $statement_detail->its_bank_tran_ref == 2) 
                                      (Customer Discount)
                                  @elseif($statement_detail->its_bank_tran_credit > 0 && $statement_detail->its_bank_tran_ref == 3) 
                                      (Credit from Supplier)
                                  @elseif($statement_detail->its_bank_tran_credit > 0 && $statement_detail->its_bank_tran_ref == 5) 
                                      (Bank Deposite)
                                  @elseif($statement_detail->its_bank_tran_debit > 0 && $statement_detail->its_bank_tran_ref == 3) 
                                      (Supplier Payment)
                                  @elseif($statement_detail->its_bank_tran_debit > 0 && $statement_detail->its_bank_tran_ref == 4) 
                                      (Supplier Discount)
                                  @elseif($statement_detail->its_bank_tran_debit > 0 && $statement_detail->its_bank_tran_ref == 6) 
                                      (Bank Withdrow)
                                  @endif
                                </td>
                                <td class="text-right">
                                    {{ $statement_detail->its_bank_tran_debit }}<span>.00</span>
                                    @php
                                        $total_debit += $statement_detail->its_bank_tran_debit;
                                    @endphp
                                </td>
                                <td class="text-right">
                                    {{ $statement_detail->its_bank_tran_credit }}<span>.00</span>
                                    @php
                                        $total_credit += $statement_detail->its_bank_tran_credit
                                    @endphp
                                </td>
                                <td class="text-right">
                                        {{ $total_credit -  $total_debit }}<span>.00</span>
                                    @php
                                      $total_balance = $total_credit -  $total_debit;
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right">
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>{{ $total_debit }}<span>.00</span></td>
                            <td>{{ $total_credit }}<span>.00</span></td>
                            <td>{{ $total_balance }}<span>.00</span></td>
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

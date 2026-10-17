@extends('user.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('supplier_statement','active')
@section('content')
    <section class="content">
        <div class="row">
          <div class="col-12 pt-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Supplier Statement</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Supplier Name</th>
                            <th class="text-right">Debit</th>
                            <th class="text-right">Credit</th>
                            <th class="text-right">Balance</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_debit = 0;
                            $total_credit = 0;
                            $total_balance = 0;
                        @endphp
                        @foreach ($suppliers as $supplier)
                            @php
                                $debit_amounts   =  App\Models\IglTailorAccount::sup_debit_amount($supplier->its_sup_slno);
                                $credit_amounts  =  App\Models\IglTailorAccount::sup_credit_amount($supplier->its_sup_slno);
                                $balance_amounts =  App\Models\IglTailorAccount::sup_balance_amount($supplier->its_sup_slno);
                            @endphp
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $supplier->its_sup_name }}</td>
                                <td class="text-right">
                                    @if (count($debit_amounts) > 0)

                                        @foreach ($debit_amounts as $debit_amount)
                                         @php
                                            $total_debit += $debit_amount->debit_amount 
                                        @endphp    
                                          {{ $debit_amount->debit_amount }}<span>.00</span>
                                        @endforeach
                                    @else
                                        <span>0.00</span>
                                    @endif  
                                </td>
                                <td class="text-right">
                                    @if (count($credit_amounts) > 0)

                                        @foreach ($credit_amounts as $credit_amount)
                                        @php
                                            $total_credit += $credit_amount->credit_amount
                                        @endphp
                                          {{ $credit_amount->credit_amount }}<span>.00</span>
                                        @endforeach
                                    @else
                                        <span>0.00</span>
                                    @endif 
                                </td>
                                <td class="text-right">
                                    @if (count($balance_amounts) > 0)

                                        @foreach ($balance_amounts as $balance_amount)
                                            @php
                                                $total_balance  += $balance_amount->total_credit - $balance_amount->total_debit
                                            @endphp
                                          {{ $balance_amount->total_credit - $balance_amount->total_debit }}<span>.00</span>
                                        @endforeach
                                    @else
                                        <span>0.00</span>
                                    @endif 
                                </td>
                                <td>
                                    <a href="{{ route('user.supplier.view-statement-details',base64_encode($supplier->its_sup_slno)) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right">
                            <td></td>
                            <td>Total</td>
                            <td>{{ $total_debit }}<span>.00</span></td>
                            <td>{{ $total_credit }}<span>.00</span></td>
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
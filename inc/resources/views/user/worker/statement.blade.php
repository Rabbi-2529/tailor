@extends('user.layout.master')
@section('worker_class','menu-open')
@section('worker_class_link','active')
@section('statement','active')
@section('content')
 <section class="content">
    <div class="row">
      <div class="col-12 pt-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Maker Payment Statements</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>SL</th>
                <th>Maker Name</th>
                <th class="text-right">Credit</th>
                <th class="text-right">Debit</th>
                <th class="text-right">Balance</th>
                <th>Details</th>
              </tr>
              </thead>
              <tbody>
                @php
                    $credit_amount = 0;
                    $debit_amount = 0;
                    $balance_amount = 0;
                @endphp
                @foreach ($makers_infom as $makers_info)
                  @php
                      $credit  =  App\Models\IglTailorAccount::maker_total_credit($makers_info->its_maker_slno);
                      $debit  =  App\Models\IglTailorAccount::maker_total_debit($makers_info->its_maker_slno);
                      $balance  =  App\Models\IglTailorAccount::maker_total_balance($makers_info->its_maker_slno);
                  @endphp
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $makers_info->its_maker_name }}</td>
                    <td class="text-right">
                        @if (count($credit) > 0)
                            @foreach ($credit as $cre)
                              @if(isset($cre->total_credit))
                                {{ $cre->total_credit }}<span>.00</span>
                                @php
                                    $credit_amount += $cre->total_credit;
                                @endphp
                              @endif
                            @endforeach
                        @else
                           <span>0.00</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @if (count($debit) > 0)
                            @foreach ($debit as $deb)
                              @if(isset($deb->total_debit))
                                {{ $deb->total_debit }}<span>.00</span>
                                @php
                                    $debit_amount += $deb->total_debit;
                                @endphp
                              @endif
                            @endforeach
                        @else
                           <span>0.00</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @if (count($balance) > 0)
                            @foreach ($balance as $bal)
                                {{ $bal->total_credit - $bal->total_debit }}<span>.00</span>
                                @php
                                    $balance_amount += $bal->total_credit - $bal->total_debit;
                                @endphp
                            @endforeach
                        @else
                           <span>0.00</span>
                        @endif
                    </td>
                    <td>
                      <a href="{{ route('user.worker.statement-view', base64_encode($makers_info->its_maker_slno)) }}" class="btn btn-info btn-sm">Statement View</a>
                    </td>
                  </tr>
                @endforeach
                <tfoot>
                  <tr class="font-weight-bold">
                    <td></td>
                    <td class="text-right">Total</td>
                    <td class="text-right">{{ ($credit_amount !="")? $credit_amount.'.00' : '0.00' }}</td>
                    <td class="text-right">{{ ($debit_amount != "")? $debit_amount.'.00' : '0.00' }}</td>
                    <td class="text-right">{{ ($balance_amount != "")? $balance_amount.'.00' : '0.00' }}</td>
                    <td></td>
                  </tr>
                </tfoot>
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
      var table = $('#example1').DataTable( {
          rowReorder: {
              selector: 'td:nth-child(2)'
          },
          responsive: true
      });
    });
</script>
@endsection
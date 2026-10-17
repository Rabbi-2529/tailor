@extends('branch.layout.master')
@section('worker_class','menu-open')
@section('worker_class_link','active')
@section('statement','active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Maker</h1>
            </div>
             <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('branch/worker/statement') }}">Maker Statments</a></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Maker Statements View</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <h4 class="mb-2">Maker Name: {{ $maker_name->its_maker_name }}</h4>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Balance</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $credit = 0;
                                    $debit = 0;
                                    $balance = 0;
                                @endphp
                                @foreach ($maker_accounting as $account)
                                    <tr class="{{ ($account->acc_credit == 0)? 'd-none':'' }}">
                                        <td>{{ $account->acc_pay_date }}</td>
                                        <td>Credit Amount (Order ID: {{ $account->acc_ord_id }})</td>
                                        <td class="text-right">
                                            {{  $account->acc_credit }}<span>.00</span>  
                                            @php
                                                $credit += $account->acc_credit
                                            @endphp   
                                        </td>
                                        <td class="text-right">
                                            0.00 
                                        </td>
                                        <td class="text-right">
                                        {{ $credit }}<span>.00</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('branch.worker.statement-details', [ base64_encode($maker_name->its_maker_slno), base64_encode($account->acc_ord_id)] ) }}" class="btn btn-info btn-sm">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($maker_accounting as $account)
                                    <tr class="{{ ($account->acc_debit == 0)? 'd-none':'' }}">
                                        <td>{{ $account->acc_pay_date }}</td>
                                        <td>Debit Amount
                                            @if(isset($account->acc_user_id))
                                              @php
                                                $user_id = $account->acc_user_id;
                                                $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                                              @endphp
                                                (Payment by {{ $user_info->UserDetailsUser->its_username }})		
                                            @else
                                               (Payment by Branch)
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            0.00 
                                        </td>
                                        <td class="text-right">
                                            {{ $account->acc_debit }}<span>.00</span>
                                            @php
                                               $debit += $account->acc_debit
                                            @endphp
                                        </td>
                                        <td class="text-right">
                                            {{ $balance = $credit - $debit }}<span>.00</span>
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="font-weight-bold">
                                    <td></td>
                                    <td class="text-right">
                                        @if (isset($maker_bonus))
                                            Total Bonus : {{ $maker_bonus }}<span>.00</span>
                                        @else
                                            Total Bonus : <span>0.00</span>
                                        @endif
                                    </td>
                                    <td class="text-right">{{ $credit }}<span>.00</span></td>
                                    <td class="text-right">
                                        @if($debit != "" )
                                          {{ $debit }}<span>.00</span>
                                          @else
                                          <span>0.00</span>
                                        @endif
                                        
                                    </td>
                                    <td class="text-right">{{ $balance }}<span>.00</span></td>
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
<link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">  
<link rel="stylesheet" href="{{ asset('assets/datatable/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.dataTables.min.css') }}">
@endsection
@section('custom_script')
<script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
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

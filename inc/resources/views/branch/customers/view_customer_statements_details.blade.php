@extends('branch.layout.master')
@section('customer_class','menu-open')
@section('customer_class_link','active')
@section('view_statements','active')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('branch.customer.view-statements') }}">View Customer Statements</a></li>
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
                <h3 class="card-title">Statement for : {{ $customer_info->its_cus_name }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                        $debit_amount = 0;
                        $credit_amount = 0;
                        $total_debit_amount = 0;
                        $total_credit_amount = 0;
                        $sl = 0
                    @endphp
                    @foreach ($account_infor as $account_info)
                      <tr>
                        <td>{{ ++$sl }}</td>
                        <td>{{ $account_info->acc_pay_date }}</td>
                        <td> 
                            @if ($account_info->acc_status == 1)
                                Order receive by  
                                  @if(isset($account_info->acc_user_id))
                                    @php
                                      $user_id = $account_info->acc_user_id;
                                      $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                                    @endphp
                                    {{ $user_info->UserDetailsUser->its_username }}	
                                    @else
                                      Branch
                                  @endif
                                (Order ID: {{ $account_info->acc_ord_id }})
                            @elseif($account_info->acc_status == 2)
                                Payment receive by 
                                @if(isset($account_info->acc_user_id))
                                  @php
                                    $user_id = $account_info->acc_user_id;
                                    $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                                  @endphp
                                    {{ $user_info->UserDetailsUser->its_username }}		
                                  @else
                                    Branch
                                @endif
                            @elseif($account_info->acc_status == 3)
                                Discount
                            @endif
                        </td>
                        <td class="text-right">
                            @php
                              $debit_amount += $account_info->acc_debit;
                              $total_debit_amount += $account_info->acc_debit;
                            @endphp

                            @if (isset($account_info->acc_debit))
                                {{  $account_info->acc_debit }}<span>.00</span>
                            @endif
                        </td>
                        <td class="text-right">
                            @php
                                $credit_amount += $account_info->acc_credit;
                                $total_credit_amount += $account_info->acc_credit;
                            @endphp 

                            @if (isset($account_info->acc_credit))
                                {{  $account_info->acc_credit }}<span>.00</span>
                            @endif
                        </td>
                        <td class="text-right">
                           {{ $balance = $credit_amount - $debit_amount }}<span>.00</span> 
                        </td>
                      </tr>
                    @endforeach
                    <tfoot>
                      <tr>
                          <td ></td>
                          <td ></td>
                          <td class="text-right text-bold">
                              Total Discount: 
                              @if(isset($discount_amount))
                                  {{ $discount_amount }}<span>.00</span>
                              @else
                                  0.00
                              @endif
                          </td>
                          <td class="text-right text-bold">
                              {{ $total_debit_amount }}<span>.00</span> 
                          </td>
                          <td class="text-right text-bold">
                              {{ $total_credit_amount }}<span>.00</span>     
                          </td>
                          <td class="text-right text-bold">
                              {{ (isset($balance))? $balance.'.00' : '0.00'}} 
                          </td>
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
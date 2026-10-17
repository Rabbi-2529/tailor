@extends('user.layout.master')
@section('supplier_information','menu-open')
@section('supplier_information_link','active')
@section('supplier_statement','active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Supplier</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('user.supplier.statement') }}">View Supplier Statements</a></li>
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
                <h3 class="card-title">Supplier Statement Details</h3>
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
                            $sl = 0;
                        @endphp
                        @foreach ($supplier_accounts as $supplier_account)
                           <tr>
                               <td>{{ ++$sl }}</td>
                               <td>{{ $supplier_account->acc_pay_date }}</td>
                               <td> 
                                    @if($supplier_account->acc_status == 6)
                                        Payment By
                                        @if(isset($supplier_account->acc_user_id) )
                                            @php
                                                $user_id = $supplier_account->acc_user_id;
                                                $user_info = App\Models\IglTailorUserUser::with('UserDetailsUser')->where('its_user_user_id',$user_id)->first();
                                            @endphp
                                                {{ $user_info->UserDetailsUser->its_username }}		
                                            @else
                                              Branch
                                        @endif
                                      @else
                                        Discount
                                    @endif
                               </td>
                               <td class="text-right">
                                   @php
                                       $total_debit += $supplier_account->acc_debit;
                                   @endphp
                                   {{ $supplier_account->acc_debit }}<span>.00</span>
                                </td>
                               <td class="text-right">
                                    @php
                                       $total_credit += $supplier_account->acc_credit;
                                    @endphp
                                   {{ $supplier_account->acc_credit }}<span>.00</span>
                                </td>
                               <td class="text-right">
                                      @php
                                          $total_balance  += $supplier_account->acc_credit - $supplier_account->acc_debit
                                      @endphp
                                   {{ $supplier_account->acc_credit - $supplier_account->acc_debit }}<span>.00</span>
                                </td>
                           </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold text-right">
                            <td></td>
                            <td></td>
                            <td>
                                Total Discount:
                                @foreach ($supplier_discount as $supplier_dis)
                                    {{ $supplier_dis->acc_debit }}<span>.00</span>
                                @endforeach
                            </td>
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
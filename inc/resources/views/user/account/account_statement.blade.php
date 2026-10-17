@extends('user.layout.master')
@section('account_class','menu-open')
@section('account_class_link','active')
@section('account_statement','active')
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-12 pt-4">
        <div class="card">
          <div class="card-header row  m-0">
            <div class="col-12 col-sm-4 my-2 p-0">
              <h3 class="card-title">Account Statement</h3>
            </div>
            <div class="col-12 col-sm-8 col-md-6 offset-md-2  p-0" id="date-option">
                <form action="{{ route('user.account.search-account-statement') }}" method="POST" class="form-row" id="account_statement">
                  @csrf
                    <div class="col-6 col-sm-4 p-0">
                      <input type="text" name="start_date" value="{{ $start_date }}" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Delivery Date"  class="form-control datepicker" required>
                    </div>
                    <div class="col-6 col-sm-4">
                      <input type="text" name="end_date" value="{{ $end_date }}" autocomplete="off" data-date-format="yyyy-mm-dd"  placeholder="Delivery Date"  class="form-control datepicker" required>
                    </div>
                    <div>
                      <button class="btn btn-success mt-2 mt-sm-0">Submit</button>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive" id="search_account_statement">
            <table  class="table table-bordered table-striped">
              <thead class="border-top">
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
                      $debit = 0;
                      $credit = 0;
                      $balance = 0;
                  @endphp
                  @foreach ($account_statements as $account_statement)
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $account_statement->acc_pay_date }}</td>
                      <td>{{ $account_statement->acc_description }}</td>
                      <td class="text-right">
                        {{ $account_statement->acc_debit }}<span>.00</span>
                        @php
                            $debit += $account_statement->acc_debit
                        @endphp
                      </td>
                      <td class="text-right">
                        {{ $account_statement->acc_credit }}<span>.00</span>
                        @php
                            $credit += $account_statement->acc_credit
                        @endphp
                      </td>
                      <td class="text-right">
                        @php
                            $balance = $credit - $debit ;
                        @endphp
                          {{  $balance }}<span>.00</span>
                      </td>
                    </tr>
                  @endforeach        
              </tbody>
              <tfoot>
                <tr class="font-weight-bold">
                  <td></td>
                  <td></td>
                  <td class="text-right">Total Discount : 
                    {{ $customer_discount + $supplier_discount }}<span>.00</span>
                  </td>
                  <td class="text-right">{{ $debit }}<span>.00</span></td>
                  <td class="text-right">{{ $credit }}<span>.00</span></td>
                  <td class="text-right">{{ $balance }}<span>.00</span></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="col-12 text-center">
            <p>Power By : <span class="font-weight-bold">IGL Web™ Ltd.</span> || 880-1958-666999</p>
          </div>
          <div class="col-12 mb-2">
            <button id="print" class="btn-secondary">Print</button>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('custom_style')
<link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('custom_script')
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
  
    $('#account_statement').on('submit',function(e){
        e.preventDefault();

        let form = $(this);
        let route = form.attr('action');
        let type = form.attr('method');
        let data = form.serialize();

        $.ajax({  
            url: route,
            type: type,
            data: data,
            success: function (result) {
              $('#search_account_statement').html(result);
            },
        });

    });
    $(function () {
        //Initialize Datepicker
        $(".datepicker").datepicker({
            autoclose: true,
        });
    })
    // Print Script
    $(document).on('click','#print',function(){
        let x = document.getElementById("print");
        let y = document.getElementById("date-option");

        x.style.display = "none";
        y.style.display = "none";
        
        window.print();

        x.style.display = "block";
        y.style.display = "block";
    })
</script>
@endsection
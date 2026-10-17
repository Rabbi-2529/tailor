@extends('branch.layout.master')
@section('cost_class','menu-open')
@section('cost_class_link','active')
@section('income_spend','active')
@section('content')
  <section class="content">
      <div class="row" id="group">
        <div class="col-12 pt-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Total Income Spend</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table  class="table table-bordered table-striped">
                <thead>
                <tr class="border-top">
                  <th>SL</th>
                  <th>Product</th>
                  <th style="width:20px">Receive Qty</th>
                  <th style="width:20px">Complete Qty</th>
                  <th style="width:20px">Maker Charge</th>
                  <th>Total MC</th>
                  <th>Price</th>
                  <th>Income</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Discount</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $sl = 0;
                    @endphp
                    @foreach ($total_income_spends as $total_income_spend)
                        @php
                            $revice_qty   = App\Models\IglTailorAddOrder::receive_qty($total_income_spend->its_add_product_name);
                            $complete_qty = App\Models\IglTailorAddOrder::complete_qty($total_income_spend->its_add_product_name);
                            $income_spends   = App\Models\IglTailorAddOrder::income_spend($total_income_spend->its_add_product_name);
                        @endphp
                        <tr>
                          <td>{{ ++$sl }}</td>
                          <td>{{ $total_income_spend->its_add_product_name }}</td>
                          <td>
                            @foreach ($revice_qty as $revice)
                                @if ($total_income_spend->its_add_product_name == $revice->its_add_product_name)
                                    {{ $revice->receive_quantity }}
                                @endif
                            @endforeach
                          </td>
                          <td>
                            @foreach ($complete_qty as $complete)
                                  @if ($total_income_spend->its_add_product_name == $complete->its_add_product_name)
                                      {{ $complete->complete_quantity }}
                                  @endif
                              @endforeach
                          </td>
                          <td>
                            @foreach ($income_spends as $income_spend)
                                @if ($total_income_spend->its_add_product_name == $income_spend->its_add_product_name)
                                    {{ $income_spend->maker_cost }}<span>.00</span>
                                @endif
                            @endforeach
                          </td>
                          <td>
                            0.00
                          </td>
                          <td>
                            @foreach ($income_spends as $income_spend)
                                @if ($total_income_spend->its_add_product_name == $income_spend->its_add_product_name)
                                    {{ $income_spend->its_add_product_price }}<span>.00</span>
                                @endif
                            @endforeach
                          </td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                          <td>0.00</td>
                        </tr>
                    @endforeach
                </tbody>
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
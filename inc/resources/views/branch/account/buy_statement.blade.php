@extends('branch.layout.master')
@section('account_class','menu-open')
@section('account_class_link','active')
@section('buy_statement','active')
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-12 pt-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Product Buy Statement</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>SL</th>
                <th>Date</th>
                <th>Supplier</th>
                <th>Invoice No</th>
                <th class="text-right">Amount</th>
                <th>Details</th>
              </tr>
              </thead>
              <tbody>
                @php
                  $sl = 0;
                  $total_amount = 0;
                @endphp
                @foreach ($buyStatement as $buy)
                  @php
                    $total_price = App\Models\IglTailorInventoryDetails::buy_total_amount($buy->its_inv_det_invoice_id);
                  @endphp
                  <tr>
                      <td>{{ ++$sl }}</td>
                      <td>{{ $buy->its_inv_det_entry_date }}</td>
                      <td>{{ $buy->supplier['its_sup_name'] }}</td>
                      <td>{{ $buy->its_inv_det_invoice_id }}</td>
                      <td class="text-right">
                        {{ $total_price }}<span>.00</span>  
                        @php
                            $total_amount += $total_price;
                        @endphp
                      </td>
                      <td class="text-center">
                          <button type="button" data-toggle="modal" data-target="#buy_statement" onclick="buy_statement('{{ $buy->its_inv_det_invoice_id }}')" class="btn btn-info">
                              <i class="fas fa-eye"></i>
                          </button>
                      </td>
                  </tr>  
                @endforeach                
              </tbody>
              <tfoot>
                <tr class="text-right">
                    <td colspan="4">Total:</td>
                    <td>{{ $total_amount }}<span>.00</span></td>
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

    <div class="modal fade" id="buy_statement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Buy Statement Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" id="statement_details">
              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </div>
      </div>
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

    function buy_statement(invoice_id)
    {
        let url = "{{ route('branch.account.buy-statement-ajax') }}";
        
        $.ajax({  
          type: "GET",
          url: url,
          data: { invoice_id: invoice_id},
          success: function (result) {
            $("#statement_details").html(result);
          }
        });
    }
</script>
@endsection
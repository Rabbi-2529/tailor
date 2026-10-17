@extends('branch.layout.master')
@section('worker_class','menu-open')
@section('worker_class_link','active')
@section('maker_pending_payment','active')
@section('content')

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-12 mt-3">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Maker Order Details</h3>
            </div>
            <div class="card-body table-responsive">
                <div class="col-md-8 col-12 d-block d-lg-none pb-2">
                    <form action="{{ route('branch.worker.search-maker-panding-payment') }}" method="POST" class="form-row">
                        @csrf
                        <div class="col-sm-4 col-12 pb-2 sm-pb-0">
                            <select class="form-control its_maker_slno select2" name="maker_slno" required>
                                  <option value="">Select One</option>
                                @foreach ($makers_infom as $makers_info)
                                  <option {{ (isset($maker_slno) && $maker_slno ==  $makers_info->its_maker_slno)? 'selected': '' }} value="{{ $makers_info->its_maker_slno }}">{{ $makers_info->its_maker_name }}</option>  
                                @endforeach
                            </select> 
                        </div>
                        <div class="col-sm-3 col-12 pb-2 sm-pb-0">
                            <input type="text" name="start_date" value="{{ $start_date }}" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control datepicker" required>
                        </div>
                        <div class="col-sm-3 col-12 pb-2 sm-pb-0">
                            <input type="text" name="end_date" value="{{ $end_date }}" autocomplete="off" data-date-format="yyyy-mm-dd"  class="form-control datepicker" required>
                        </div>
                        <div>
                          <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Complete</th>
                                    <th class="text-center">Incomplete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $shirt_quantity_complete = 0;      $shirt_quantity_incomplete = 0;
                                    $pant_quantity_complete = 0;       $pant_quantity_incomplete = 0;
                                    $blazer_quantity_complete = 0;     $blazer_quantity_incomplete = 0;
                                    $panjabi_quantity_complete = 0;    $panjabi_quantity_incomplete = 0;
                                    $payjama_quantity_complete = 0;    $payjama_quantity_incomplete = 0;
                                    $safari_quantity_complete = 0;     $safari_quantity_incomplete = 0;
                                    $photua_quantity_complete = 0;     $photua_quantity_incomplete = 0;
                                    $mojibcort_quantity_complete = 0;  $mojibcort_quantity_incomplete = 0;
                                    $kable_quantity_complete = 0;      $kable_quantity_incomplete = 0;
                                    $koti_quantity_complete = 0;       $koti_quantity_incomplete = 0;
                                    
                                    $total_complete = 0;
                                    $total_incomplete = 0;
                                @endphp
                                <tr>
                                    <td>1</td>
                                    <td class="text-center">
                                        Shirt
                                    </td>
                                    <td class="text-center">
                                        @if (isset($shirt_complete) && count($shirt_complete) > 0)
                                            @foreach ($shirt_complete as $shirt_quantity)
                                                @php
                                                    $shirt_quantity_complete += $shirt_quantity->its_add_product_quantity
                                                @endphp
    
                                                @php
                                                    $total_complete += $shirt_quantity->its_add_product_quantity * $shirt_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $shirt_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($shirt_incomplete) && count($shirt_incomplete) > 0)
                                            @foreach ($shirt_incomplete as $shirt_quantity)
                                                @php
                                                    $shirt_quantity_incomplete += $shirt_quantity->its_add_product_quantity
                                                @endphp
    
                                                @php
                                                    $total_incomplete += $shirt_quantity->its_add_product_quantity * $shirt_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $shirt_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="text-center">
                                        Pant
                                    </td>
                                    <td class="text-center">
                                        @if (isset($pant_complete) && count($pant_complete) > 0)
                                            @foreach ($pant_complete as $pant_quantity)
                                                @php
                                                    $pant_quantity_complete += $pant_quantity->its_add_product_quantity;
                                                @endphp                                            
                                                @php
                                                    $total_complete += $pant_quantity->its_add_product_quantity * $pant_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $pant_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($pant_incomplete) && count($pant_incomplete) > 0)
                                            @foreach ($pant_incomplete as $pant_quantity)
                                                @php
                                                    $pant_quantity_incomplete += $pant_quantity->its_add_product_quantity;
                                                @endphp 
    
                                                @php
                                                    $total_incomplete += $pant_quantity->its_add_product_quantity * $pant_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                             {{ $pant_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td class="text-center">
                                        Blazer          
                                    </td>
                                    <td class="text-center">
                                        @if (isset($blazer_complete) && count($blazer_complete) > 0)
                                            @foreach ($blazer_complete as $blazer_quantity)
                                                @php
                                                    $blazer_quantity_complete += $blazer_quantity->its_add_product_quantity 
                                                @endphp
    
                                                @php
                                                    $total_complete += $blazer_quantity->its_add_product_quantity * $blazer_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $blazer_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($blazer_incomplete) && count($blazer_incomplete) > 0)
                                            @foreach ($blazer_incomplete as $blazer_quantity)
                                                @php
                                                    $blazer_quantity_incomplete +=$blazer_quantity->its_add_product_quantity
                                                @endphp
                                        
                                                @php
                                                    $total_incomplete += $blazer_quantity->its_add_product_quantity * $blazer_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $blazer_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td class="text-center">
                                        Panjabi
                                    </td>
                                    <td class="text-center">
                                         @if (isset($panjabi_complete) && count($panjabi_complete) > 0)
                                            @foreach ($panjabi_complete as $panjabi_quantity)
                                                @php
                                                    $panjabi_quantity_complete += $panjabi_quantity->its_add_product_quantity
                                                @endphp
    
                                                @php
                                                    $total_complete += $panjabi_quantity->its_add_product_quantity * $panjabi_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $panjabi_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($panjabi_incomplete) && count($panjabi_incomplete) > 0)
                                            @foreach ($panjabi_incomplete as $panjabi_quantity)
                                                @php
                                                    $panjabi_quantity_incomplete += $panjabi_quantity->its_add_product_quantity
                                                @endphp
    
                                                @php
                                                    $total_incomplete += $panjabi_quantity->its_add_product_quantity * $panjabi_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $panjabi_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td class="text-center">
                                        Payjama
                                    </td>
                                    <td class="text-center">
                                        @if (isset($payjama_complete) && count($payjama_complete) > 0)
                                            @foreach ($payjama_complete as $payjama_quantity)
                                                @php
                                                    $payjama_quantity_complete += $payjama_quantity->its_add_product_quantity 
                                                @endphp
    
                                                @php
                                                    $total_complete += $payjama_quantity->its_add_product_quantity * $payjama_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $payjama_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($payjama_incomplete) && count($payjama_incomplete) > 0)
                                        @foreach ($payjama_incomplete as $payjama_quantity)
                                                @php
                                                    $payjama_quantity_incomplete += $payjama_quantity->its_add_product_quantity 
                                                @endphp
    
                                                @php
                                                    $total_incomplete += $payjama_quantity->its_add_product_quantity * $payjama_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $payjama_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td class="text-center">
                                        Safari
                                    </td>
                                    <td class="text-center">
                                         @if (isset($safari_complete) && count($safari_complete) > 0)
                                            @foreach ($safari_complete as $safari_quantity)
                                                @php
                                                    $safari_quantity_complete += $safari_quantity->its_add_product_quantity    
                                                @endphp
    
                                                @php
                                                    $total_complete += $safari_quantity->its_add_product_quantity * $safari_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $safari_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($safari_incomplete) && count($safari_incomplete) > 0)
                                            @foreach ($safari_incomplete as $safari_quantity)
                                                @php
                                                    $safari_quantity_incomplete += $safari_quantity->its_add_product_quantity    
                                                @endphp
    
                                                @php
                                                    $total_incomplete += $safari_quantity->its_add_product_quantity * $safari_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $safari_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td class="text-center">
                                        Photua
                                    </td>
                                    <td class="text-center">
                                        @if (isset($photua_complete) && count($photua_complete) > 0)
                                            @foreach ($photua_complete as $photua_quantity)
                                                @php
                                                    $photua_quantity_complete += $photua_quantity->its_add_product_quantity
                                                @endphp
                                                @php
                                                    $total_complete += $photua_quantity->its_add_product_quantity * $photua_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $photua_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                         @if (isset($photua_incomplete) && count($photua_incomplete) > 0)
                                            @foreach ($photua_incomplete as $photua_quantity)
                                                @php
                                                    $photua_quantity_incomplete +=  $photua_quantity->its_add_product_quantity
                                                @endphp
    
                                                @php
                                                    $total_incomplete += $photua_quantity->its_add_product_quantity * $photua_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $photua_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td class="text-center">
                                        Mojib Cort
                                    </td>
                                    <td class="text-center">
                                        @if (isset($mojibcort_complete) && count($mojibcort_complete) > 0)
                                            @foreach ($mojibcort_complete as $mojibcort_quantity)
                                                @php
                                                    $mojibcort_quantity_complete += $mojibcort_quantity->its_add_product_quantity
                                                @endphp
    
                                                @php
                                                    $total_complete += $mojibcort_quantity->its_add_product_quantity * $mojibcort_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $mojibcort_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                         @if (isset($mojibcort_incomplete) && count($mojibcort_incomplete) > 0)
                                            @foreach ($mojibcort_incomplete as $mojibcort_quantity)
                                                @php
                                                   $mojibcort_quantity_incomplete +=$mojibcort_quantity->its_add_product_quantity 
                                                @endphp
    
                                                @php
                                                    $total_incomplete += $mojibcort_quantity->its_add_product_quantity * $mojibcort_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $mojibcort_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td class="text-center">
                                        Kable
                                    </td>
                                    <td class="text-center">
                                        @if (isset($kable_complete) && count($kable_complete) > 0)
                                            @foreach ($kable_complete as $kable_quantity)
                                                @php
                                                    $kable_quantity_complete += $kable_quantity->its_add_product_quantity
                                                @endphp
                                                @php
                                                    $total_complete += $kable_quantity->its_add_product_quantity * $kable_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $kable_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                         @if (isset($kable_incomplete) && count($kable_incomplete) > 0)
                                            @foreach ($kable_incomplete as $kable_quantity)
                                                @php
                                                    $kable_quantity_incomplete += $kable_quantity->its_add_product_quantity;
                                                @endphp
    
                                                @php
                                                    $total_incomplete += $kable_quantity->its_add_product_quantity * $kable_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $kable_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td class="text-center">
                                        Koti
                                    </td>
                                    <td class="text-center">
                                        @if (isset($koti_complete) && count($koti_complete) > 0)
                                            @foreach ($koti_complete as $koti_quantity)
                                                @php
                                                    $koti_quantity_complete += $koti_quantity->its_add_product_quantity    
                                                @endphp
    
                                                @php
                                                    $total_complete += $koti_quantity->its_add_product_quantity * $koti_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $koti_quantity_complete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td class="text-center">
                                         @if (isset($koti_incomplete) && count($koti_incomplete) > 0)
                                            @foreach ($koti_incomplete as $koti_quantity)
                                                @php
                                                    $koti_quantity_incomplete +=  $koti_quantity->its_add_product_quantity
                                                @endphp
                                                @php
                                                    $total_incomplete += $koti_quantity->its_add_product_quantity * $koti_quantity->its_add_maker_cost_amount;
                                                @endphp                                            
                                            @endforeach
                                            {{ $koti_quantity_incomplete }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        @if ($total_complete > 0)
                                            Total Complete Payment : <span  class="text-bold">{{ $total_complete }}.00</span>
                                        @else
                                            Total Complete Payment : <span  class="text-bold">0.00</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($total_incomplete > 0)
                                            Total Pending Payment : <span  class="text-bold">{{ $total_incomplete }}.00</span>
                                        @else
                                            Total Pending Payment : <span  class="text-bold">0.00</span>
                                        @endif
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Complete Paid : <span class="text-bold">{{ (isset($maker_payment_paid))? $maker_payment_paid.'.00' : '0.00'  }} </span> </td>
                                    <td>Rest Paid : <span class="text-bold">{{ (isset($maker_payment_paid))? $total_complete - $maker_payment_paid.'.00' : '0.00'  }}</span></td>
                                    <td>Bonus : <span class="text-bold">{{ (isset($maker_bonus))? $maker_bonus.'.00' : '0.00' }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-none d-lg-block col-lg-6 col-12 ">
                        <form action="{{ route('branch.worker.search-maker-panding-payment') }}" method="POST" class="form-row">
                            @csrf
                            <div class="col-4">
                                <select class="form-control its_maker_slno select2" name="maker_slno" required>
                                      <option value="">Select One</option>
                                    @foreach ($makers_infom as $makers_info)
                                      <option {{ (isset($maker_slno) && $maker_slno ==  $makers_info->its_maker_slno)? 'selected': '' }} value="{{ $makers_info->its_maker_slno }}">{{ $makers_info->its_maker_name }}</option>  
                                    @endforeach
                                </select> 
                            </div>
                            <div class="col-3">
                                <input type="text" name="start_date" value="{{ $start_date }}" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control datepicker" required>
                            </div>
                            <div class="col-3">
                                <input type="text" name="end_date" value="{{ $end_date }}" autocomplete="off" data-date-format="yyyy-mm-dd"  class="form-control datepicker" required>
                            </div>
                            <div>
                              <button class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
           </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('custom_style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('custom_script')
<script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
    $(function () {
        $('.select2').select2();
        $('.datepicker').datepicker({
            daysOfWeekHighlighted: "7",
            autoclose: true,
            todayHighlight: true,
        });
    })
    // Buttton Submit After Disabled
    $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection
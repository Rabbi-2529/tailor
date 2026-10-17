@extends('branch.layout.master')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
<h5>Customer Name : {{ $customer_info->its_cus_name ?? 'N/A' }} ({{ $customer_info->its_cus_mobile ?? 'N/A' }})</h5>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container">
      <div class="row">
        <div class="offset-md-3 col-md-6 ">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Take Measure</h3>
            </div>
                <div class="card-body">
                    <div class="row">
                      @if (in_array('shirt',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                             @if (Session::get('oldShirtMeasuerment'))
                               <input  type="hidden" id="oldShirtMeasuerment" {{ (Session::get('oldShirtMeasuerment'))?  "value=3" : "value=0"  }}>
                               <button  class="btn btn-{{ (Session::get('oldShirtMeasuerment'))? 'primary': 'success' }}"   data-target="#shirt" data-toggle="modal">
                                  Shirt
                                </button>
                            @else
                              <button  class="btn btn-{{ (Session::get('shirtMeasureId'))? 'info': 'success' }}"   data-target="#shirt" data-toggle="modal">                             
                                Shirt
                                @if(Session::get('shirtMeasureId'))
                                  <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                @endif 
                               </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Shirt Measure Condition Start --}}
                      @if (in_array('shirt',$check_product_name))
                          @if (Session::get('shirtMeasureId'))
                              <input type="hidden" class="shirt_name" value="2">  
                          @else
                              <input type="hidden" class="check_shirt"  value="1">   
                          @endif
                        @else
                          <input type="hidden" class="check_shirt" value="0">  
                      @endif
                      {{-- Check Shirt Measure Condition End --}}    
                      @if (in_array('pant',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                            @if (Session::get('oldPantMeasuerment'))
                              <input  type="hidden" id="oldPantMeasuerment" {{ (Session::get('oldPantMeasuerment'))?  "value=3" : "value=0"  }}>
                               <button  class="btn btn-{{ (Session::get('oldPantMeasuerment'))? 'primary': 'success' }}"   data-target="#pant" data-toggle="modal">
                                  Pant 
                                </button>
                            @else
                              <button class="btn btn-{{ (Session::get('pantMeasureId'))? 'info': 'success' }}" data-target="#pant" data-toggle="modal">
                                  Pant 
                                  @if(Session::get('pantMeasureId'))
                                    <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                  @endif
                              </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Pant Measure Condition Start --}}
                      @if (in_array('pant',$check_product_name))
                          @if (Session::get('pantMeasureId'))
                              <input type="hidden" class="pant_name" value="2">  
                          @else
                              <input type="hidden" class="check_pant"  value="1">   
                          @endif
                        @else
                          <input type="hidden" class="check_pant" value="0">  
                      @endif
                      {{-- Check Pant Measure Condition End --}}    
                      @if (in_array('blazer',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                             @if (Session::get('oldBlazerMeasuerment'))
                               <input  type="hidden" id="oldBlazerMeasuerment" {{ (Session::get('oldBlazerMeasuerment'))?  "value=3" : "value=0"  }}>
                               <button  class="btn btn-{{ (Session::get('oldBlazerMeasuerment'))? 'primary': 'success' }}"   data-target="#blazer" data-toggle="modal">
                                  Blazer  
                                </button>
                            @else
                              <button class="btn btn-{{ (Session::get('blazerMeasureId'))? 'info': 'success' }}" data-target="#blazer" data-toggle="modal">
                                  Blazer  
                                  @if(Session::get('blazerMeasureId'))
                                    <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                  @endif
                            </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Blazer Measure Condition Start --}}
                      @if (in_array('blazer',$check_product_name))
                          @if (Session::get('blazerMeasureId'))
                              <input type="hidden" class="blazer_name" value="2">  
                          @else
                              <input type="hidden" class="check_blazer"  value="1">   
                          @endif
                        @else
                          <input type="hidden" class="check_blazer" value="0">  
                      @endif
                      {{-- Check Blazer Measure Condition End --}}  
                    
                      @if (in_array('panjabi',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                             @if (Session::get('oldPanjabiMeasuerment'))
                               <input  type="hidden" id="oldPanjabiMeasuerment" {{ (Session::get('oldPanjabiMeasuerment'))?  "value=3" : "value=0" }}>
                               <button  class="btn btn-{{ (Session::get('oldPanjabiMeasuerment'))? 'primary': 'success' }}"   data-target="#panjabi" data-toggle="modal">
                                  Panjabi
                                </button>
                            @else
                              <button class="btn btn-{{ (Session::get('panjabiMeasureId'))? 'info': 'success' }}" data-target="#panjabi" data-toggle="modal">
                                  Panjabi
                                  @if(Session::get('panjabiMeasureId'))
                                    <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                  @endif
                             </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Panjabi Measure Condition Start --}}
                        @if (in_array('panjabi',$check_product_name))
                            @if (Session::get('panjabiMeasureId'))
                                <input type="hidden" class="panjabi_name" value="2">  
                            @else
                                <input type="hidden" class="check_panjabi"  value="1">   
                            @endif
                          @else
                            <input type="hidden" class="check_panjabi" value="0">  
                        @endif
                      {{-- Check Panjabi Measure Condition End --}}      
                      @if (in_array('payjama',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                             @if (Session::get('oldPayjamaMeasuerment'))
                               <input  type="hidden" id="oldPayjamaMeasuerment" {{ (Session::get('oldPayjamaMeasuerment'))?  "value=3" : "value=0"  }}>
                               <button  class="btn btn-{{ (Session::get('oldPayjamaMeasuerment'))? 'primary': 'success' }}"   data-target="#payjama" data-toggle="modal">
                                  Payjama  
                                </button>
                            @else
                              <button class="btn btn-{{ (Session::get('payjamaMeasureId'))? 'info': 'success' }}" data-target="#payjama" data-toggle="modal">
                                  Payjama  
                                  @if(Session::get('payjamaMeasureId'))
                                    <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                  @endif
                            </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Payjama Measure Condition Start --}}
                        @if (in_array('payjama',$check_product_name))
                            @if (Session::get('payjamaMeasureId'))
                                <input type="hidden" class="payjama_name" value="2">  
                            @else
                                <input type="hidden" class="check_payjama"  value="1">   
                            @endif
                          @else
                            <input type="hidden" class="check_payjama" value="0">  
                        @endif
                      {{-- Check Payjama Measure Condition End --}}  
                      @if (in_array('safari',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                            @if (Session::get('oldSafariMeasuerment'))
                               <input  type="hidden" id="oldSafariMeasuerment" {{ (Session::get('oldSafariMeasuerment'))?  "value=3" : "value=0"  }}>
                               <button  class="btn btn-{{ (Session::get('oldSafariMeasuerment'))? 'primary': 'success' }}"   data-target="#safari" data-toggle="modal">
                                  Safari
                                </button>
                            @else
                                <button class="btn btn-{{ (Session::get('safariMeasureId'))? 'info': 'success' }}" data-target="#safari" data-toggle="modal">
                                    Safari
                                    @if(Session::get('safariMeasureId'))
                                      <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                    @endif
                              </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Safari Measure Condition Start --}}
                        @if (in_array('safari',$check_product_name))
                            @if (Session::get('safariMeasureId'))
                                <input type="hidden" class="safari_name" value="2">  
                            @else
                                <input type="hidden" class="check_safari"  value="1">   
                            @endif
                          @else
                            <input type="hidden" class="check_safari" value="0">  
                        @endif
                      {{-- Check Safari Measure Condition End --}}  
                      @if (in_array('photua',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                            @if (Session::get('oldPhotuaMeasuerment'))
                               <input  type="hidden" id="oldPhotuaMeasuerment" {{ (Session::get('oldPhotuaMeasuerment'))?  "value=3" : "value=0" }}>
                               <button  class="btn btn-{{ (Session::get('oldPhotuaMeasuerment'))? 'primary': 'success' }}"   data-target="#photua" data-toggle="modal">
                                  Photua
                                </button>
                            @else
                              <button class="btn btn-{{ (Session::get('photuaMeasureId'))? 'info': 'success' }}" data-target="#photua" data-toggle="modal">
                                  Photua
                                  @if(Session::get('photuaMeasureId'))
                                    <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                  @endif
                                </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Blazer Measure Condition Start --}}
                        @if (in_array('photua',$check_product_name))
                            @if (Session::get('photuaMeasureId'))
                                <input type="hidden" class="photua_name" value="2">  
                            @else
                                <input type="hidden" class="check_photua"  value="1">   
                            @endif
                          @else
                            <input type="hidden" class="check_photua" value="0">  
                        @endif
                      {{-- Check Blazer Measure Condition End --}}  
                      @if (in_array('mojib_cort',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                            @if (Session::get('oldMojibCortMeasuerment'))
                               <input  type="hidden" id="oldMojibCortMeasuerment" {{ (Session::get('oldMojibCortMeasuerment'))?  "value=3" : "value=0"  }}>
                               <button  class="btn btn-{{ (Session::get('oldMojibCortMeasuerment'))? 'primary': 'success' }}"   data-target="#mojib" data-toggle="modal">
                                  Mojib Cort 
                                </button>
                            @else
                              <button class="btn btn-{{ (Session::get('mojibCortMeasureId'))? 'info': 'success' }}" data-target="#mojib" data-toggle="modal">
                                  Mojib Cort 
                                  @if(Session::get('mojibCortMeasureId'))
                                    <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                  @endif
                             </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Mojib Cort Measure Condition Start --}}
                        @if (in_array('mojib_cort',$check_product_name))
                            @if (Session::get('mojibCortMeasureId'))
                                <input type="hidden" class="mojib_cort_name" value="2">  
                              @else
                                  <input type="hidden" class="check_mojib_cort"  value="1">   
                              @endif
                             @else
                            <input type="hidden" class="check_mojib_cort" value="0">  
                        @endif
                      {{-- Check Mojib Cort Measure Condition End --}}  
                      @if (in_array('kable',$check_product_name))
                        <div class="col-sm-4 col-6 mb-2">
                            @if (Session::get('oldKableMeasuerment'))
                               <input  type="hidden" id="oldKableMeasuerment" {{ (Session::get('oldKableMeasuerment'))?  "value=3" : "value=0"  }}>
                               <button  class="btn btn-{{ (Session::get('oldKableMeasuerment'))? 'primary': 'success' }}"   data-target="#kable" data-toggle="modal">
                                  Kable
                                </button>
                            @else
                              <button class="btn btn-{{ (Session::get('kableMeasureId'))? 'info': 'success' }}" data-target="#kable" data-toggle="modal">
                                  Kable 
                                  @if(Session::get('kableMeasureId'))
                                    <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                  @endif
                            </button>
                            @endif
                        </div>
                      @endif
                      {{-- Check Kable Measure Condition Start --}}
                        @if (in_array('kable',$check_product_name))
                            @if (Session::get('kableMeasureId'))
                                <input type="hidden" class="kable_name" value="2">  
                            @else
                                <input type="hidden" class="check_kable"  value="1">   
                            @endif
                          @else
                            <input type="hidden" class="check_kable" value="0">  
                        @endif
                      {{-- Check Kable Measure Condition End --}}  
                      @if (in_array('koti',$check_product_name))
                          <div class="col-sm-4 col-6 mb-2">
                              @if (Session::get('oldKotiMeasuerment'))
                                  <input  type="hidden" id="oldKotiMeasuerment" {{ (Session::get('oldKotiMeasuerment'))?  "value=3" : "value=0"  }}>
                                  <button  class="btn btn-{{ (Session::get('oldKotiMeasuerment'))? 'primary': 'success' }}"   data-target="#koti" data-toggle="modal">
                                    Koti 
                                  </button>
                              @else
                                <button class="btn btn-{{ (Session::get('kotiMeasureId'))? 'info': 'success' }}" data-target="#koti" data-toggle="modal">
                                    Koti 
                                    @if(Session::get('kotiMeasureId'))
                                        <i style="margin-left: 3px;font-size: 12px;" class="fas fa-check"></i>
                                    @endif
                                </button>
                              @endif
                          </div>
                        @endif
                       {{-- Check Kable Measure Condition Start --}}
                        @if (in_array('koti',$check_product_name))
                            @if (Session::get('kotiMeasureId'))
                                <input type="hidden" class="koti_name" value="2">  
                            @else
                                <input type="hidden" class="check_koti"  value="1">   
                            @endif
                          @else
                            <input type="hidden" class="check_koti" value="0">  
                        @endif
                       {{-- Check Kable Measure Condition End --}}  
                    </div>

                    {{ Form::open(['route' => ['branch.measure.delivey-date'] , 'method' => 'get', 'id' =>'form-submit']) }}
                      
                        <div class="col-md-4 px-0 pt-2 pb-2" id="deliveryDate" style="display: none;">
                          <input type="text" id="delivery_date" autocomplete="off" data-date-format="yyyy-mm-dd" placeholder="Delivery Date" name="delivery" class="form-control" required>
                        </div>
                        <div class="abcd">
                            <button type="button" class="btn btn-danger mt-2" onclick="deliveryDateClick()" id="form-submit-button">Finish Order and Print</button>   
                        </div>
                      
                        <input type="hidden" id="temp_slNo" name="temp_slNo" value="{{ json_encode($temp_slNos) }}">
                        
                        <input type="hidden" id="order_id" name="order_id" value="{{ $order_id }}">    
                        <input type="hidden" id="customer_id" name="customer_id" value="{{ $customer_id }}">
                        
                    {{ Form::close() }}
                                  
                </div>
            </div>
         </div>
       </div>
    </div><!-- /.container-fluid -->
  </section>

    @php
        // shirt Data Show
        if(Session::get('shirtMeasureId')){
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('shirtMeasureId'))->first();
            $shirt_info = App\Models\IglTailorMsrShirt::where('its_shirt_msr_slno', $order_info->its_add_order_measure_id)->first();          
        }
        // pant Data Show
        if (Session::get('pantMeasureId')) {
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('pantMeasureId'))->first();
            $pant_info = App\Models\IglTailorMsrPant::where('its_pant_measure_slno', $order_info->its_add_order_measure_id)->first();
        }
        // blazer Data Show
        if (Session::get('blazerMeasureId')) {
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('blazerMeasureId'))->first();
            $blazer_info = App\Models\IglTailorMsrBlazer::where('its_blazer_measure_slno', $order_info->its_add_order_measure_id)->first();
        }
        // blazer Data Show
        if (Session::get('panjabiMeasureId')) {     
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('panjabiMeasureId'))->first();
            $panjabi_info = App\Models\IglTailorMsrPanjabi::where('its_panjabi_msr_slno', $order_info->its_add_order_measure_id)->first();
        }
        // payjama Data Show
        if (Session::get('payjamaMeasureId')) {     
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('payjamaMeasureId'))->first();
            $payjama_info = App\Models\IglTailorMsrPayjama::where('its_payjama_measure_slno', $order_info->its_add_order_measure_id)->first();
        }
        // safari Data Show
        if (Session::get('safariMeasureId')) {     
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('safariMeasureId'))->first();
            $safari_info = App\Models\IglTailorMsrSafari::where('its_safari_measure_slno', $order_info->its_add_order_measure_id)->first();
        }
        // photua Data Show
        if (Session::get('photuaMeasureId')) {     
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('photuaMeasureId'))->first();
            $photua_info = App\Models\IglTailorMsrPhotua::where('its_photua_measure_slno', $order_info->its_add_order_measure_id)->first();
        }
        // mojibCort Data Show
        if (Session::get('mojibCortMeasureId')) {     
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('mojibCortMeasureId'))->first();
            $mojibcort_info = App\Models\IglTailorMsrMojibCort::where('its_mojibcort_measure_slno', $order_info->its_add_order_measure_id)->first();
        }
        // kable Data Show
        if (Session::get('kableMeasureId')) {     
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('kableMeasureId'))->first();
            $kable_info = App\Models\IglTailorMsrKable::where('its_kable_measure_slno', $order_info->its_add_order_measure_id)->first();
        }
        // koti Data Show
        if (Session::get('kotiMeasureId')) {     
            $order_info = App\Models\IglTailorAddOrder::select('its_add_order_slno','its_add_order_order_id','its_add_order_measure_id')->where('its_add_order_slno', Session::get('kotiMeasureId'))->first();
            $koti_info = App\Models\IglTailorMsrKoti::where('its_koti_measure_slno', $order_info->its_add_order_measure_id)->first();
        }
    @endphp

    @include('branch.pages.measure.shirt_measure')
    @include('branch.pages.measure.pant_measure')
    @include('branch.pages.measure.blazer_measure')
    @include('branch.pages.measure.panjabi_measure')
    @include('branch.pages.measure.payjama_measure')
    @include('branch.pages.measure.safari_measure')
    @include('branch.pages.measure.photua_measure')
    @include('branch.pages.measure.mojib_cort_measure')
    @include('branch.pages.measure.kable_measure')
    @include('branch.pages.measure.koti_measure')
@endsection


@section('custom_style')
  <link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">    
@endsection


@section('custom_script')
    <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery.bangla.js')}}"></script>
    <script>
        $('.phonetic').bangla();	
        $('.phonetic').bangla('toggle'); 

        $(function () {
        //Date range picker
            $('#delivery_date').datepicker({
               daysOfWeekHighlighted: "7",
               autoclose: true,
               todayHighlight: true,
               startDate: new Date()
            });
        })
    </script>
    @include('branch.pages.measure.measure_edit_form_fill')
    <script>
         function deliveryDateClick() {

            let check_shirt = $('.check_shirt').val();
            let shirt_name = $('.shirt_name').val();

            let check_pant = $('.check_pant').val();
            let pant_name = $('.pant_name').val();

            let check_blazer = $('.check_blazer').val();
            let blazer_name = $('.blazer_name').val();

            let check_panjabi = $('.check_panjabi').val();
            let panjabi_name = $('.panjabi_name').val();

            let check_payjama = $('.check_payjama').val();
            let payjama_name = $('.payjama_name').val();

            let check_safari = $('.check_safari').val();
            let safari_name = $('.safari_name').val();

            let check_photua = $('.check_photua').val();
            let photua_name = $('.photua_name').val();

            let check_mojib_cort = $('.check_mojib_cort').val();
            let mojib_cort_name = $('.mojib_cort_name').val();

            let check_kable = $('.check_kable').val();
            let kable_name = $('.kable_name').val();

            let koti_name = $('.koti_name').val();
            let check_koti = $('.check_koti').val();
            
            let oldShirtMeasuerment =  $('#oldShirtMeasuerment').val();
            let oldPantMeasuerment =   $('#oldPantMeasuerment').val();
            let oldBlazerMeasuerment = $('#oldBlazerMeasuerment').val();
            let oldPanjabiMeasuerment = $('#oldPanjabiMeasuerment').val();
            let oldPayjamaMeasuerment = $('#oldPayjamaMeasuerment').val();
            let oldSafariMeasuerment = $('#oldSafariMeasuerment').val();
            let oldPhotuaMeasuerment = $('#oldPhotuaMeasuerment').val();
            let oldMojibCortMeasuerment = $('#oldMojibCortMeasuerment').val();
            let oldKableMeasuerment = $('#oldKableMeasuerment').val();
            let oldKotiMeasuerment = $('#oldKotiMeasuerment').val();
            

            let x = document.getElementById("deliveryDate");

            if (check_shirt != 0)
            {
                if(oldShirtMeasuerment == 3)
                {
                    alert("Check Shirt Measurement and Save") 
                    x.style.display = "none";
                    return false;
                }
                else
                {
                    if(shirt_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
    
                        x.style.display = "none";
                        alert("Take Shirt Measurement") 
                        return false;
                    }    
                }
            }
            if (check_pant != 0)
            {
                if(oldPantMeasuerment == 3)
                {
                    alert("Check Pant Measurement and Save") 
                    x.style.display = "none";
                    return false;
                } 
                else
                {
                    if(pant_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
                        alert("Take Pant Measurement") 
                        x.style.display = "none";
                        return false;
                    }   
                } 
            }
            
            if (check_blazer != 0)
            {
                if (oldBlazerMeasuerment == 3) 
                {
                    alert("Check Blazer Measurement and Save") 
                    x.style.display = "none";
                    return false;
                } 
                else {
                     if(blazer_name == 2)
                      {
                        if (x.style.display === "none") {
                          x.style.display = "block";
                        }
                      }
                      else{
                          alert("Take Blazer Measurement") 
                          x.style.display = "none";
                          return false;
                      }    
                }  
            }
            if (check_panjabi != 0)
            {
                if(oldPanjabiMeasuerment == 3)
                { 
                    alert("Check Panjabi Measurement and Save") 
                    x.style.display = "none";
                    return false;
                } 
                else
                {
                    if(panjabi_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
                        alert("Take Panjabi Measurement") 
                        x.style.display = "none";
                        return false;
                    }  
                } 
            }
            
            if (check_payjama != 0)
            {

               if (oldPayjamaMeasuerment == 3) 
               {
                  alert("Check Payjama Measurement and Save") 
                  x.style.display = "none";
                  return false;
               } 
               else 
               {
                   if(payjama_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
                        alert("Take Payjama Measurement") 
                        x.style.display = "none";
                        return false;
                    }    
               }  
            }
            if (check_safari != 0)
            {
                if (oldSafariMeasuerment == 3) 
                {
                    alert("Check Safari Measurement and Save") 
                    x.style.display = "none";
                    return false;
                } 
                else 
                {
                    if(safari_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
                        alert("Take Safari Measurement") 
                        x.style.display = "none";
                        return false;
                    } 
                }   
            }
            if (check_photua != 0)
            {
                if (oldPhotuaMeasuerment == 3) {
                    alert("Check Photua Measurement and Save") 
                    x.style.display = "none";
                    return false;
                } 
                else 
                {
                    if(photua_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
                        alert("Take Photua Measurement") 
                        x.style.display = "none";
                        return false;
                    }  
                }    
            }
            if (check_mojib_cort != 0)
            {
               if (oldMojibCortMeasuerment == 3) 
               {
                    alert("Check Mojib Cort Measurement and Save") 
                    x.style.display = "none";
                    return false;
               } 
               else 
               {
                   if(mojib_cort_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
                        alert("Take Mojib Cort Measurement") 
                        x.style.display = "none";
                        return false;
                    }      
               }
            }
            if (check_kable != 0)
            {
                if (oldKableMeasuerment == 3) 
                {
                    alert("Check Kable Measurement and Save") 
                    x.style.display = "none";
                    return false;
                } 
                else {
                  if(kable_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
                        alert("Take Kable Measurement") 
                        x.style.display = "none";
                        return false;
                    }    
                  }  
            }
            
            if (check_koti != 0)
            {
               if (oldKotiMeasuerment == 3) 
               {
                    alert("Check Koti Measurement and Save") 
                    x.style.display = "none";
                    return false;
               } 
               else {
                   if(koti_name == 2)
                    {
                      if (x.style.display === "none") {
                        x.style.display = "block";
                      }
                    }
                    else{
                        alert("Take Koti Measurement") 
                        x.style.display = "none";
                        return false;
                    }    
               }  
            }
        }

        $(document).ready(function () {
          $("#form-submit-button").click(function () {
              let submit_button = "<button  type='submit' onclick='deliveryDateClick()' class='btn btn-danger float-left'>Finish Order and Print</button>";
              $('.abcd').html(submit_button);
          });
        });
        // Invoice Create For Order
        $('#form-submit').on('submit',function(e){
           e.preventDefault();
           
            let form = $(this);
            let url  = form.attr('action');
            let type = form.attr('method');
            let delivery_date = $('#delivery_date').val();
            let temp_slNo     = $('#temp_slNo').val();
            let order_id     = $('#order_id').val();
            let customer_id     = $('#customer_id').val();

            let _token = "{{ csrf_token() }}";

            $.ajax({
              type: type,
              url : url,
              data: { order_id:order_id,customer_id:customer_id,delivery_date:delivery_date, temp_slNo:temp_slNo, _token:_token},
              success: function (result){
                  window.open("{{ route('branch.measure.finish-order-print', base64_encode($order_id)) }}", "PopupWindow", "width=800,height=600,scrollbars=yes,resizable=no");
                 
                  window.location.href = "{{ route('branch.order.order-now') }}";
              }
            })
        });
      // Input Type Number Arrow Keyup Not Work Script
    $(document).ready(function() {
      $("input[type=number]").on("focus", function() {
          $(this).on("keydown", function(event) {
              if (event.keyCode === 38 || event.keyCode === 40) {
                  event.preventDefault();
              }
          });
        });
    })
    // disable mousewheel on a input number field when in focus
    $('form').on('focus', 'input[type=number]', function (e) {
      $(this).on('wheel.disableScroll', function (e) {
        e.preventDefault()
      })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
      $(this).off('wheel.disableScroll')
    })
    // Buttton Submit After Disabled
    $('form').submit(function() {
       $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection
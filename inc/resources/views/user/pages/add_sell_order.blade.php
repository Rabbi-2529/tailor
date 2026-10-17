@extends('user.layout.master')
@section('content')
  @php
    $order_id = App\Models\IglTailorTemporary::where('its_temp_submit_by',Auth::User()->its_slno)->first();
  @endphp
  <!-- Main content -->
  <section class="content pt-3">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-5">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cart</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @if (Session::has('order_panding') == 1)
               
                <h5 class="py-5 px-1 text-center">
                    Already {{ ($order_id != "")? $order_id->its_temp_order_id : '' }} No Order Panding.

                    <a href="{{ route('user.measure.take-measure') }}">Click</a> Complete Panding Order
                </h5>

            @else
                {{ Form::open(['route' => 'user.order.order-now-insert' , 'method' => 'post']) }}
                  <div class="card-body">
                      <table class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  {{-- <th class="text-center">SL</th> --}}
                                  <th class="text-center" style="width:10%">Name</th>
                                  <th class="text-center" style="width:10%">Price</th>
                                  <th class="text-center" style="width:5%">Qty</th>
                                  <th class="text-center" style="width:5%">Add</th>
                              </tr>
                          </thead>
                          <tbody>
                            @if($price != "")
                            @if($price->its_price_list_shirt != 0)
                              <tr>
                                  {{-- <td class="text-center">1</td> --}}
                                  <td class="text-center">
                                    Shirt
                                  </td>
                                  <td class="text-right">
                                    {{ $price->its_price_list_shirt }}
                                    <input type="hidden" name="price" class="price_shirt" value="{{ $price->its_price_list_shirt }}">
                                  </td>
                                  <td>
                                      <input type="number" name="quantity" class="form-control qty_shirt" style="width: 60px;" placeholder="Qty">
                                  </td>
                                  <td class="text-center">
                                    <button type="button" onclick="addToCart('shirt')" class="btn btn-success btn-sm">
                                      <i class="fas fa-plus"></i>
                                    </button>
                                  </td>
                              </tr>
                              @endif

                              @if($price->its_price_list_pant != 0)
                              <tr>
                                  {{-- <td class="text-center">2</td> --}}
                                  <td class="text-center">
                                    Pant
                                  </td>
                                  <td class="text-right">
                                    {{ $price->its_price_list_pant }}
                                    <input type="hidden" name="price" class="price_pant" value="{{ $price->its_price_list_pant }}">
                                  </td>
                                  <td>
                                      <input type="number" name="quantity" class="form-control qty_pant" style="width: 60px;" placeholder="Qty">
                                  </td>
                                  <td class="text-center">
                                    <button type="button" onclick="addToCart('pant')" class="btn btn-success btn-sm">
                                      <i class="fas fa-plus"></i>
                                    </button>
                                  </td>
                              </tr>
                              @endif

                              @if($price->its_price_list_blazer != 0)
                                <tr>
                                    {{-- <td class="text-center">3</td> --}}
                                    <td class="text-center">
                                      Blazer          
                                    </td>
                                    <td class="text-right">
                                      {{ $price->its_price_list_blazer }}
                                      <input type="hidden" name="price" class="price_blazer" value="{{ $price->its_price_list_blazer }}">
                                    </td>
                                    <td>
                                        <input type="number" name="quantity" class="form-control qty_blazer" style="width: 60px;" placeholder="Qty">
                                    </td>
                                    <td class="text-center">
                                      <button type="button" onclick="addToCart('blazer')" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                      </button>
                                    </td>
                                </tr>
                              @endif

                              @if($price->its_price_list_panjabi != 0)
                              <tr>
                                  {{-- <td class="text-center">4</td> --}}
                                  <td class="text-center">
                                    Panjabi
                                  </td>
                                  <td class="text-right">
                                    {{ $price->its_price_list_panjabi }}
                                    <input type="hidden" name="price" class="price_panjabi" value="{{ $price->its_price_list_panjabi }}">
                                  </td>
                                  <td>
                                      <input type="number" name="quantity" class="form-control qty_panjabi" style="width: 60px;" placeholder="Qty">
                                  </td>
                                  <td class="text-center">
                                    <button type="button" onclick="addToCart('panjabi')" class="btn btn-success btn-sm">
                                      <i class="fas fa-plus"></i>
                                    </button>
                                  </td>
                              </tr>
                              @endif

                              @if($price->its_price_list_payjama != 0)
                              <tr>
                                  {{-- <td class="text-center">5</td> --}}
                                  <td class="text-center">
                                    Payjama
                                  </td>
                                  <td class="text-right">
                                    {{ $price->its_price_list_payjama }}
                                    <input type="hidden" name="price" class="price_payjama" value="{{ $price->its_price_list_payjama }}">
                                  </td>
                                  <td>
                                      <input type="number" name="quantity" class="form-control qty_payjama" style="width: 60px;" placeholder="Qty">
                                  </td>
                                  <td class="text-center">
                                    <button type="button" onclick="addToCart('payjama')" class="btn btn-success btn-sm">
                                      <i class="fas fa-plus"></i>
                                    </button>
                                  </td>
                              </tr>
                              @endif
        
                              @if($price->its_price_list_safari != 0)
                              <tr>
                                  {{-- <td class="text-center">6</td> --}}
                                  <td class="text-center">
                                    Safari
                                  </td>
                                  <td class="text-right">
                                    {{ $price->its_price_list_safari }}
                                    <input type="hidden" name="price" class="price_safari" value="{{ $price->its_price_list_safari }}">
                                  </td>
                                  <td>
                                      <input type="number" name="quantity" class="form-control qty_safari" style="width: 60px;" placeholder="Qty">
                                  </td>
                                  <td class="text-center">
                                    <button type="button" onclick="addToCart('safari')" class="btn btn-success btn-sm">
                                      <i class="fas fa-plus"></i>
                                    </button>
                                  </td>
                              </tr>
                              @endif

                              @if($price->its_price_list_photua != 0)
                              <tr>
                                  {{-- <td class="text-center">7</td> --}}
                                  <td class="text-center">
                                    Photua
                                  </td>
                                  <td class="text-right">
                                    {{ $price->its_price_list_photua }}
                                    <input type="hidden" name="price" class="price_photua" value="{{ $price->its_price_list_photua }}">
                                  </td>
                                  <td>
                                      <input type="number" name="quantity" class="form-control qty_photua" style="width: 60px;" placeholder="Qty">
                                  </td>
                                  <td class="text-center">
                                    <button type="button" onclick="addToCart('photua')" class="btn btn-success btn-sm">
                                      <i class="fas fa-plus"></i>
                                    </button>
                                  </td>
                              </tr>
                              @endif

                              @if($price->its_price_list_mojib_cort != 0)
                              <tr>
                                  {{-- <td class="text-center">8</td> --}}
                                  <td class="text-center">
                                    Mojib Cort
                                  </td>
                                  <td class="text-right">
                                    {{ $price->its_price_list_mojib_cort }}
                                    <input type="hidden" name="price" class="price_mojib_cort" value="{{ $price->its_price_list_mojib_cort }}">
                                  </td>
                                  <td>
                                      <input type="number" name="quantity" class="form-control qty_mojib_cort" style="width: 60px;" placeholder="Qty">
                                  </td>
                                  <td class="text-center">
                                    <button type="button" onclick="addToCart('mojib_cort')" class="btn btn-success btn-sm">
                                      <i class="fas fa-plus"></i>
                                    </button>
                                  </td>
                              </tr>
                              @endif

                              @if($price->its_price_list_kable != 0)
                                <tr>
                                    {{-- <td class="text-center">9</td> --}}
                                    <td class="text-center">
                                      Kable
                                    </td>
                                    <td class="text-right">
                                      {{ $price->its_price_list_kable }}
                                      <input type="hidden" name="price" class="price_kable" value="{{ $price->its_price_list_kable }}">
                                    </td>
                                    <td>
                                        <input type="number" name="quantity" class="form-control qty_kable" style="width: 60px;" placeholder="Qty">
                                    </td>
                                    <td class="text-center">
                                      <button type="button" onclick="addToCart('kable')" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                      </button>
                                    </td>
                                </tr>
                              @endif

                              @if($price->its_price_list_koti != 0)
                                <tr>
                                  <td class="text-center">
                                    Koti
                                  </td>
                                  <td class="text-right">
                                    {{ $price->its_price_list_koti }}
                                    <input type="hidden" name="price" class="price_koti" value="{{ $price->its_price_list_koti }}">
                                  </td>
                                  <td>
                                      <input type="number" name="quantity" class="form-control qty_koti" style="width: 60px;" placeholder="Qty">
                                  </td>
                                  <td class="text-center">
                                    <button type="button" onclick="addToCart('koti')" class="btn btn-success btn-sm">
                                      <i class="fas fa-plus"></i>
                                    </button>
                                  </td>
                                </tr>
                              @endif
                            @endif
                          </tbody>
                      </table>
                  </div>
                  <!-- /.card-body -->
                {{ Form::close() }}
            @endif
          </div>
        </div>
        <div class="col-md-7">
          <!-- general form elements disabled -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Customer</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <input type="hidden" class="check_order"> 
                {{ Form::open(['route' => 'user.measure.take-measure' , 'method' => 'post']) }}
                <div class="row">
                  <div class="col-sm-12">
                    <!-- select -->
                    <div class="form-group">
                      <label>Select</label>
                      <select class="form-control select2" id="customer_id" name="customer_id" required>
                        <option value="">Select One</option>
                        @foreach ($customers as $cus)
                          @php
                              $bran = Auth::user()->UserDetails->its_user_bran_id;
                              $branch_ids = explode(',',$cus->its_cus_bran_id); 
                          @endphp
                          @if (in_array($bran, $branch_ids))
                            <option value="{{ $cus->its_cus_slno }}">
                                {{ $cus->its_cus_name }} / {{ $cus->its_cus_mobile }}
                            </option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    
                  </div>
                </div>
                @if (Session::has('order_panding') == 0)
                  <div class="col-sm-12" id="show-cart-content">
  
                  </div>
                  
                  <div class="card-footer abcd">
                    <button type="button" {{  ($price == "")? 'disabled': '' }} class="btn btn-primary float-right" id="form-submit-button">Submit</button>
                  </div>
                @endif
                
              {{ Form::close() }}
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  
@endsection
@section('custom_style')
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
  <style>
      .form-control::-webkit-inner-spin-button,
      .form-control::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
      }
      </style>
@endsection
@section('custom_script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
        $(function () {
          $('.select2').select2();
           
           getCartProduct();
        })
</script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
  

    @if(session()->has('order'))
      Swal.fire(
        "Submited!",
        "{{ session()->get('order') }}",
        "success",
      )
    @endif

    function addToCart(product) {

        let quantity = $(".qty_"+product).val();
        let service = product;
        let price = $(".price_"+product).val();
        let _token = "{{ csrf_token() }}";
        let route_url = "{{ route('user.order.order-now-insert') }}";
        
        $.ajax({
            type: "POST",
            url: route_url,
            data: { service: service, quantity: quantity, price:price, _token: _token},
            success: function (result) {
              if (result == 410) {
                alert("Invalid Service");
              } else if (result == 411) {
                alert("Quantity Required");
              } else if (result == 412) {
                alert("Invalid Price");
              } else if (result == 400) {
                alert("Invalid Service");
              } else if (result == 200) {
                getCartProduct();
                 $('.check_order').val(1);
              } else {
                alert(result);
              }
              
            }
        });
    }

    function getCartProduct() {
      let route_url = "{{ route('user.order.get-cart-content') }}";
      $.ajax({
          type: "GET",
          url: route_url,
          data: {},
          success: function (result) {
              $("#show-cart-content").html(result);
              
          }
      });
    }

    function delete_data(route){
      var _token=$("#_token").val();
      
        // e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    // redirect url
                    $.ajax({  
                        type: "GET",
                        url: route,
                        data: { _token:_token},
                        success: function (result) {
                        console.log(result);
                        getCartProduct();
                        }
                    });
                } 
            });
    }

    $(document).ready(function () {
      $("#form-submit-button").click(function () {
            let submit_button = "<button type='submit' class='btn btn-danger float-right'>Take Measurement</button>";
            $('.abcd').html(submit_button);
        });
    });

  
</script>
@endsection
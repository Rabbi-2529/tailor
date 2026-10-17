@extends('branch.layout.master')
@section('price_update','menu-open')
@section('price_update_link','active')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" id="price">
        <div class="row">
            <div class="offset-md-3 col-md-6 pt-4">
                <div class="card card-info">
                  <div class="card-header">
                    @if($prices != "")
                      <h3 class="card-title">Price Update</h3>
                    @else
                      <h3 class="card-title">Price Set</h3>
                    @endif
                  </div>
                  {{ Form::open(['route' => ['branch.price-update.price-update-insert'] , 'method' => 'post' , 'class' => 'form-horizontal']) }}
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="shirt" class="col-sm-3 col-form-label">Shirt Price</label>
                        <div class="col-sm-9">
                          <input type="text" name="shirt" class="form-control" :value="price.its_price_list_shirt" id="" placeholder="Shirt">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="pant" class="col-sm-3 col-form-label">Pant Price</label>
                        <div class="col-sm-9">
                          <input type="text" name="pant" class="form-control" :value="price.its_price_list_pant" id="" placeholder="Pant">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="blazer" class="col-sm-3 col-form-label">Blazer Price</label>
                        <div class="col-sm-9">
                          <input type="blazer" name="blazer" class="form-control" :value="price.its_price_list_blazer" id="" placeholder="Blazer">
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="panjabi" class="col-sm-3 col-form-label">Panjabi Price</label>
                          <div class="col-sm-9">
                              <input type="text" name="panjabi" class="form-control" :value="price.its_price_list_panjabi" id="" placeholder="Panjabi">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="payjama" class="col-sm-3 col-form-label">Payjama Price</label>
                          <div class="col-sm-9">
                              <input type="text" name="payjama" class="form-control" :value="price.its_price_list_payjama" id="" placeholder="Payjama">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="safari" class="col-sm-3 col-form-label">Safari Price</label>
                          <div class="col-sm-9">
                              <input type="text" name="safari" class="form-control" :value="price.its_price_list_safari" id="" placeholder="Safari">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="photua" class="col-sm-3 col-form-label">Photua Price</label>
                          <div class="col-sm-9">
                              <input type="text" name="photua" class="form-control" :value="price.its_price_list_photua" id="" placeholder="Photua">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="mojib_cort" class="col-sm-3 col-form-label">Mojib Cort Price</label>
                          <div class="col-sm-9">
                              <input type="text" name="mojib_cort" class="form-control" :value="price.its_price_list_mojib_cort" id="" placeholder="Mojib Cort">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="kable" class="col-sm-3 col-form-label">Kable Price</label>
                          <div class="col-sm-9">
                              <input type="text" name="kable" class="form-control" :value="price.its_price_list_kable" id="" placeholder="Kable">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="koti" class="col-sm-3 col-form-label">Koti Price</label>
                          <div class="col-sm-9">
                              <input type="text" name="koti" class="form-control" :value="price.its_price_list_koti" id="" placeholder="Koti">
                          </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      @if($prices != "")
                        <button type="submit" class="btn btn-info float-right">Update</button>
                      @else
                        <button type="submit" class="btn btn-info float-right">Submit</button>
                      @endif
                      
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
@section('custom_script')
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
  let app = new Vue({
    el: '#price',
    data: {
      price: {!! json_encode($prices) !!}
    }
  });

  @if(session()->has('price_update'))
    Swal.fire(
      "Submited!",
      "{{ session()->get('price_update') }}",
      "success",
    )
  @endif

  @if(session()->has('price_up'))
    Swal.fire(
      "Updated!",
      "{{ session()->get('price_up') }}",
      "success",
    )
  @endif
  function delete_data(link){
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
                  window.location.replace(link);
              } 
          });
  }
  @if(session()->has('price_del'))
    Swal.fire(
      "Deleted!",
      "{{ session()->get('price_del') }}",
      "success",
    )
  @endif
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
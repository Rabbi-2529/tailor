@extends('user.layout.master')
@section('cost_class','menu-open')
@section('cost_class_link','active')
@section('making_cost','active')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" id="cost">
        <div class="row">
          <div class="offset-md-3 col-md-6 pt-4">
          
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Making Cost</h3>
              </div>
            
              {{ Form::open(['action' => 'user\CostController@CostSetting' , 'method' => 'post' , 'class' => 'form-horizontal']) }}                   
              
                <div class="card-body">
                  <div class="form-group row">
                    <label for="shirt" class="col-sm-3 col-form-label">Shirt Price</label>
                    <div class="col-sm-9">
                      <input type="text" name="shirt" value="{{ old('shirt') }}" class="form-control" :value="cost.its_worker_shirt" id="" placeholder="Shirt">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="pant" class="col-sm-3 col-form-label">Pant Price</label>
                    <div class="col-sm-9">
                      <input type="text" name="pant" value="{{ old('pant') }}" class="form-control" :value="cost.its_worker_pant" id="" placeholder="Pant">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="blazer" class="col-sm-3 col-form-label">Blazer Price</label>
                    <div class="col-sm-9">
                      <input type="blazer" name="blazer" value="{{ old('blazer') }}" class="form-control" :value="cost.its_worker_blazer" id="" placeholder="Blazer">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label for="panjabi" class="col-sm-3 col-form-label">Panjabi Price</label>
                      <div class="col-sm-9">
                          <input type="text" name="panjabi" value="{{ old('panjabi') }}" class="form-control" :value="cost.its_worker_panjabi" id="" placeholder="Panjabi">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="payjama" class="col-sm-3 col-form-label">Payjama Price</label>
                      <div class="col-sm-9">
                          <input type="text" name="payjama" value="{{ old('payjama') }}" class="form-control" :value="cost.its_worker_payjama" id="" placeholder="Payjama">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="safari" class="col-sm-3 col-form-label">Safari Price</label>
                      <div class="col-sm-9">
                          <input type="text" name="safari" value="{{ old('safari') }}" class="form-control" :value="cost.its_worker_safari" id="" placeholder="Safari">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="photua" class="col-sm-3 col-form-label">Photua Price</label>
                      <div class="col-sm-9">
                          <input type="text" name="photua" value="{{ old('photua') }}" class="form-control" :value="cost.its_worker_photua" id="" placeholder="Photua">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="mojib_cort" class="col-sm-3 col-form-label">Mojib Cort Price</label>
                      <div class="col-sm-9">
                          <input type="text" name="mojib_cort" value="{{ old('mojib_cort') }}" class="form-control" :value="cost.its_worker_mojib_cort" id="" placeholder="Mojib Cort">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="kable" class="col-sm-3 col-form-label">Kable Price</label>
                      <div class="col-sm-9">
                          <input type="text" name="kable" value="{{ old('kable') }}" class="form-control" :value="cost.its_worker_kable" id="" placeholder="Kable">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="koti" class="col-sm-3 col-form-label">Koti Price</label>
                      <div class="col-sm-9">
                          <input type="text" name="koti" value="{{ old('koti') }}" class="form-control" :value="cost.its_worker_koti" id="" placeholder="Koti">
                      </div>
                  </div>
                </div>
                <div class="card-footer">
                  @if($costs != "")
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
  var app = new Vue({
    el: '#cost',
    data: {
      cost: {!! json_encode($costs) !!}
    }
  });

  @if(session()->has('cost'))
    Swal.fire(
        "Submited!",
        "{{ session()->get('cost') }}",
        "success"
    )
  @endif
</script>
@endsection
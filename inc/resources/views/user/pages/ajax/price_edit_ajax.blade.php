<input type="text" value="{{ $priceUpdate->its_price_list_slno }}" name="price_id" hidden>
<div class="card-body" id="group">
        <div class="form-group">
          <label for="exampleInputEmail1">Service Name</label>
          <input type="text" name="name" class="form-control" id="" value="{{ $priceUpdate->its_price_list_name }}" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Service Price</label>
            <input type="text" name="price" class="form-control" id="" value="{{ $priceUpdate->its_price_list_price }}" placeholder="Enter Price">
        </div>

  </div>
      <!-- /.card-body -->

  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
        $(function () {
          $('.select2').select2()
        })
</script>

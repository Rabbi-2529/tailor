@extends('user.layout.master')
@section('product_information','menu-open')
@section('product_information_link','active')
@section('add_group','active')
@section('content')
<section class="content">
    <div class="container-fluid" id="pro_group">
      <div class="row">
        <!-- left column -->
        <div class="offset-md-3 col-md-6 pt-5 mt-4">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Product Group</h3>
            </div>
            {{ Form::open(['action' => 'user\ProductInformationController@AddGroupInsert' , 'method' => 'post']) }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Group Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="" placeholder="Enter Group Name" required>
                    @error('name')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
            {{ Form::close() }}
          </div>

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('custom_style')
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection
@section('custom_script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
  $(function () {
    $('.select2').select2()
  })

  $('form').submit(function() {
      $(this).find("button[type='submit']").prop('disabled',true);
  });

  @if(session()->has('already_insert'))
    Swal.fire(
      "Already!",
      "{{ session()->get('already_insert') }}",
      "error",
    )
  @endif
  
  @if(session()->has('group'))
    Swal.fire(
      "Successfully!",
      "{{ session()->get('group') }}",
      "success",
    )
  @endif
</script>
@endsection
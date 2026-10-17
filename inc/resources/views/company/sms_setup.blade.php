@extends('company.layout.master')
@section('sms','menu-open')
@section('sms_setup_link','active')
@section('content')
    <section class="content">
      <div class="row">
        <div class="col-12 col-sm-6 py-4 offset-sm-2">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">SMS Setup</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{ Form::open(['route' => ['company.sms-setup-insert'] , 'method' => 'post']) }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sender ID<span style="color: red;">*</span></label>
                            <input type="text" name="sender_id" value="{{ old('sender_id') }}" class="form-control" autocomplete="off" placeholder="Enter Sender ID">
                            @error('sender_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">API Key<span style="color: red;">*</span></label>
                            <input type="text"  name="api_key" value="{{ old('api_key') }}" class="form-control" iautocomplete="off" placeholder="Enter API Key">
                            @error('api_key')
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
      </div>
    </section>
@endsection
@section('custom_script')
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
<script>
    @if(session()->has('sms_setup'))
      Swal.fire(
        "Successfully!",
        "{{ session()->get('sms_setup') }}",
        "success",
      )
    @endif
    @if(session()->has('already_insert'))
      Swal.fire(
        "Already!",
        "{{ session()->get('already_insert') }}",
        "error",
      )
    @endif
    // Form Submit After Button Disabled
    $('form').submit(function() {
         $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
@endsection

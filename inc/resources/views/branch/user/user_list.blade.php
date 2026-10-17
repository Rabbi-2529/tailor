@extends('branch.layout.master')
@section('user_class','menu-open')
@section('user_class_link','active')
@section('user_list','active')
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-12 pt-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">User List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>E-mail</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $user->UserDetailsUser->its_username }}</td>
                    <td>{{ $user->UserDetailsUser->its_mobile }}</td>
                    <td>{{ $user->UserDetailsUser->its_email }}</td>
                    <td>{{ $user->UserDetailsUser->its_address }}</td>
                    <td>
                      @if($user->its_user_status == 1)
                        <button class="btn btn-success" style="padding: 0px 8px">
                          Active
                        </button>
                      @else
                        <button class="btn btn-danger" style="padding: 0px 8px">
                          Inactive
                        </button>
                      @endif
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info">Action</button>
                        <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu text-center">
                          <a href="{{ route('branch.user.user-edit', base64_encode($user->its_user_slno) ) }}" >Update</a>
                          <div class="dropdown-divider"></div>
                          <a href="{{ route('branch.user.user-menu-permission', base64_encode($user->its_user_slno)) }}">Menu Permision</a>
                          <div class="dropdown-divider"></div>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
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
</script>
@endsection
@extends('admin.layout.master')
@section('branch_list_class','menu-open')
@section('branch_list_class_link','active')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Branch</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="row" id="branch" v-cloak>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Branch List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              @php
                  $sl = 0;
              @endphp
              <tbody>
                @foreach ($branches as $branche)
                  <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ $branche->its_username }}</td>
                    <td>{{ $branche->its_mobile }}</td>
                    <td>{{ $branche->its_address }}</td>
                    <td>
                      @if($branche->BranchDetailsUser->its_branch_status == 2) 
                        <button class="btn btn-danger" style="padding: 0px 8px">
                            Suspend
                        </button>
                      @elseif($branche->BranchDetailsUser->its_branch_expire_date >= $current_date) 
                          <button class="btn btn-success" style="padding: 0px 8px">
                            Active
                          </button>
                      @else
                        <button class="btn btn-danger" style="padding: 0px 8px">
                            Expired
                        </button>
                      @endif
                    </td>
                    <td>
                      @if($branche->BranchDetailsUser->its_branch_expire_date < $current_date) 
                        <button type="button" data-toggle="modal" data-target="#active{{ $branche->its_slno }}" class="btn btn-success" style="padding: 0px 8px">
                           Active
                        </button>
                      @elseif($branche->BranchDetailsUser->its_branch_status == 1) 
                        <button type="button" data-toggle="modal" data-target="#suspended{{ $branche->its_slno }}" class="btn btn-danger" style="padding: 0px 8px">
                          Suspend
                        </button>
                      @elseif($branche->BranchDetailsUser->its_branch_status == 2)
                        <button type="button" data-toggle="modal" data-target="#suspended{{ $branche->its_slno }}" class="btn btn-info" style="padding: 0px 8px">
                           Continue
                        </button>
                      @endif
                    </td>
                  </tr>
                    {{-- Active Modal --}}
                    <div class="modal fade" id="active{{ $branche->its_slno }}" tabindex="-1" role="dialog" aria-labelledby="active" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                         <form action="{{ route('admin.branch-active') }}" method="post">
                            @csrf
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Branch Active</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  <div class="col-6">
                                      <label for="">Licence Expired Date</label>
                                      <input type="text" autocomplete="off" name="expired_date"  data-date-format="yyyy-mm-dd" class="form-control datepicker" required >
                                  </div>
                                  <input type="hidden" value="{{ $branche->its_slno }}" name="branch_id">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                              </div>
                            </div>
                         </form>
                      </div>
                    </div>
                    {{-- Suspended Modal --}}
                    <div class="modal fade" id="suspended{{ $branche->its_slno }}" tabindex="-1" role="dialog" aria-labelledby="suspended" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <form action="{{ route('admin.branch-suspend-unsuspend') }}" method="post">
                            @csrf
                            <div class="modal-content">
                              <div class="modal-header">
                                  @if($branche->BranchDetailsUser->its_branch_status == 1) 
                                    <h5 class="modal-title" id="exampleModalLabel">Branch Suspend</h5>

                                  @elseif($branche->BranchDetailsUser->its_branch_status == 2)
                                    <h5 class="modal-title" id="exampleModalLabel">Branch Continue</h5>
                                  @endif
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                @if($branche->BranchDetailsUser->its_branch_status == 1) 
                                  <h5 class="modal-title">Are you sure you suspend this branch ?</h5>

                                @elseif($branche->BranchDetailsUser->its_branch_status == 2)
                                  <h5 class="modal-title">Are you sure you continue this branch ?</h5>
                                @endif
                                <input type="hidden" value="{{ $branche->its_slno }}" name="branch_id">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                              </div>
                            </div>
                        </form>
                      </div>
                    </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('custom_style')
  <link rel="stylesheet" href="{{ asset('assets/datatable/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/datatable/css/rowReorder.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('custom_script')
  <script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
  <script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/datatable/js/dataTables.rowReorder.min.js') }}"></script>
  <script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
  <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
  $(document).ready(function() {
      let table = $('#example1').DataTable({
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true
    });
  });

  $(function () {
    $(".datepicker").datepicker({
        autoclose: true,
    });
  })

  @if(session()->has('suspend'))
    Swal.fire(
        "Submited!",
        "{{ session()->get('suspend') }}",
        "success"
    )
  @endif
  @if(session()->has('unsuspend'))
    Swal.fire(
        "Submited!",
        "{{ session()->get('unsuspend') }}",
        "success"
    )
  @endif
  @if(session()->has('branch_active'))
    Swal.fire(
        "Submited!",
        "{{ session()->get('branch_active') }}",
        "success"
    )
  @endif

</script>
@endsection
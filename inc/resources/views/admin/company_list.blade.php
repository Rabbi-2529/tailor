@extends('admin.layout.master')
@section('com_list_class','menu-open')
@section('com_list_link','active')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Company</h1>
            </div>
          </div>
        </div>
      </section>

     <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Company List</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($companies as $com)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $com->its_username }}</td>
                      <td>{{ $com->its_mobile }}</td>
                      <td>{{ $com->its_address }}</td>
                      <td>{{ $com->CompanyDetailsUser?->its_company_website }}</td>
                      <td>
                        @if($com->CompanyDetailsUser?->its_company_status == 2)
                            <button class="btn btn-danger" style="padding: 0px 8px">Suspend</button>
                        @elseif($com->CompanyDetailsUser?->its_company_expire_date >= $current_date)
                            <button class="btn btn-success" style="padding: 0px 8px">Active</button>
                        @else
                            <button class="btn btn-danger" style="padding: 0px 8px">Expired</button>
                        @endif
                      </td>
                      <td>
                        <button type="button"
                                class="btn btn-warning btn-edit-company"
                                data-id="{{ $com->its_slno }}"
                                style="padding: 0px 8px">
                            Edit
                        </button>

                        @if($com->CompanyDetailsUser?->its_company_expire_date < $current_date)
                          <button type="button" data-toggle="modal" data-target="#active{{ $com->its_slno }}" class="btn btn-success" style="padding: 0px 8px">Active</button>
                        @elseif($com->CompanyDetailsUser?->its_company_status == 1)
                          <button type="button" data-toggle="modal" data-target="#suspended{{ $com->its_slno }}" class="btn btn-danger" style="padding: 0px 8px">Suspend</button>
                        @elseif($com->CompanyDetailsUser?->its_company_status == 2)
                          <button type="button" data-toggle="modal" data-target="#suspended{{ $com->its_slno }}" class="btn btn-info" style="padding: 0px 8px">Continue</button>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

      {{-- ============== PER-ROW MODALS ============== --}}
      @foreach($companies as $com)
        <div class="modal fade" id="active{{ $com->its_slno }}" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form action="{{ route('admin.company-active') }}" method="post">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Company Active</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="col-6">
                          <label>Licence Expired Date</label>
                          <input type="text" autocomplete="off" name="expired_date" data-date-format="yyyy-mm-dd" class="form-control datepicker" required>
                      </div>
                      <input type="hidden" value="{{ $com->its_slno }}" name="company_id">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                  </div>
                </div>
            </form>
          </div>
        </div>

        <div class="modal fade" id="suspended{{ $com->its_slno }}" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form action="{{ route('admin.company-suspend-unsuspend') }}" method="post">
                @csrf
                <div class="modal-content">
                  <div class="modal-header">
                      @if($com->CompanyDetailsUser?->its_company_status == 1)
                        <h5 class="modal-title">Company Suspend</h5>
                      @elseif($com->CompanyDetailsUser?->its_company_status == 2)
                        <h5 class="modal-title">Company Continue</h5>
                      @endif
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    @if($com->CompanyDetailsUser?->its_company_status == 1)
                      <h5 class="modal-title">Are you sure you suspend this company ?</h5>
                    @elseif($com->CompanyDetailsUser?->its_company_status == 2)
                      <h5 class="modal-title">Are you sure you continue this company ?</h5>
                    @endif
                    <input type="hidden" value="{{ $com->its_slno }}" name="company_id">
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

      {{-- ============== EDIT MODAL ============== --}}
      <div class="modal fade" id="editCompanyModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <form id="editCompanyForm" action="{{ route('admin.company-update') }}" method="POST">
              @csrf
              <input type="hidden" name="user_id" id="edit_user_id">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Company</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <h6 class="text-primary mb-2">Account Info</h6>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="company" id="edit_company" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Mobile <span class="text-danger">*</span></label>
                        <input type="text" name="mobile" id="edit_mobile" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Password <small class="text-muted">(leave blank to keep)</small></label>
                        <input type="text" name="pass" id="edit_pass" class="form-control" placeholder="New password (optional)">
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Address <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="edit_address" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <hr>
                  <h6 class="text-primary mb-2">Company Details</h6>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Fax</label>
                        <input type="text" name="fax" id="edit_fax" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Website</label>
                        <input type="text" name="website" id="edit_website" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" name="zip" id="edit_zip" class="form-control">
                      </div>
                    </div>
                  </div>

                  {{-- ==== DIVISION / DISTRICT / UPAZILA ==== --}}
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Division <span class="text-danger">*</span></label>
                        <select name="division_id" id="edit_division_id" class="form-control" required>
                          <option value="">-- Select Division --</option>
                          @foreach($divisions ?? [] as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>District <span class="text-danger">*</span></label>
                        <select name="district_id" id="edit_district_id" class="form-control" required>
                          <option value="">-- Select District --</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Upazila <span class="text-danger">*</span></label>
                        <select name="upzila_id" id="edit_upzila_id" class="form-control" required>
                          <option value="">-- Select Upazila --</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Business Type</label>
                        <input type="text" name="b_type" id="edit_b_type" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Company Type</label>
                        <input type="text" name="c_type" id="edit_c_type" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Open Time</label>
                        <input type="text" name="open" id="edit_open" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Close Time</label>
                        <input type="text" name="close" id="edit_close" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Taxable</label>
                        <input type="text" name="tax" id="edit_tax" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Expire Date <span class="text-danger">*</span></label>
                        <input type="text" name="expire" id="edit_expire" autocomplete="off"
                               class="form-control datepicker" data-date-format="yyyy-mm-dd" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Sender ID</label>
                        <input type="text" name="sender_id" id="edit_sender_id" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>API Key</label>
                        <input type="text" name="api_key" id="edit_api_key" class="form-control">
                      </div>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
          </form>
        </div>
      </div>
@endsection

@section('custom_style')
  <link rel="stylesheet" href="{{ asset('assets/datatable/css/jquery.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/datatable/css/rowReorder.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/datatable/css/responsive.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.css') }}">
@endsection

@section('custom_script')
  <script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/datatable/js/dataTables.rowReorder.min.js') }}"></script>
  <script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>

<script>
    $(document).ready(function() {
      $('#example1').DataTable({
          rowReorder: { selector: 'td:nth-child(2)' },
          responsive: true
      });
    });

    $(function () {
      $(".datepicker").datepicker({ autoclose: true });
    });

    /* ============================================================
     |  DEPENDENT DROPDOWNS
     |  Reuses existing routes:
     |    admin.district-name-show
     |    admin.upazila-name-show
     ============================================================ */
    function loadDistricts(division_id, selected_district_id, callback) {
        $('#edit_district_id').html('<option value="">Loading...</option>');
        $('#edit_upzila_id').html('<option value="">-- Select Upazila --</option>');

        if (!division_id) {
            $('#edit_district_id').html('<option value="">-- Select District --</option>');
            if (callback) callback();
            return;
        }

        $.ajax({
            url: "{{ route('admin.district-name-show') }}",
            type: "GET",
            data: { division_id: division_id },
            dataType: "json",
            success: function (rows) {
                var html = '<option value="">-- Select District --</option>';
                $.each(rows, function (i, row) {
                    html += '<option value="' + row.id + '">' + row.name + '</option>';
                });
                $('#edit_district_id').html(html);

                if (selected_district_id) {
                    $('#edit_district_id').val(selected_district_id);
                }
                if (callback) callback();
            },
            error: function (xhr) {
                console.log('district-name-show error:', xhr.responseText);
                $('#edit_district_id').html('<option value="">-- Select District --</option>');
                if (callback) callback();
            }
        });
    }

    function loadUpazilas(district_id, selected_upazila_id) {
        $('#edit_upzila_id').html('<option value="">Loading...</option>');

        if (!district_id) {
            $('#edit_upzila_id').html('<option value="">-- Select Upazila --</option>');
            return;
        }

        $.ajax({
            url: "{{ route('admin.upazila-name-show') }}",
            type: "GET",
            data: { district_id: district_id },
            dataType: "json",
            success: function (rows) {
                var html = '<option value="">-- Select Upazila --</option>';
                $.each(rows, function (i, row) {
                    html += '<option value="' + row.id + '">' + row.name + '</option>';
                });
                $('#edit_upzila_id').html(html);

                if (selected_upazila_id) {
                    $('#edit_upzila_id').val(selected_upazila_id);
                }
            },
            error: function (xhr) {
                console.log('upazila-name-show error:', xhr.responseText);
                $('#edit_upzila_id').html('<option value="">-- Select Upazila --</option>');
            }
        });
    }

    $(document).on('change', '#edit_division_id', function () {
        loadDistricts($(this).val(), null, null);
    });

    $(document).on('change', '#edit_district_id', function () {
        loadUpazilas($(this).val(), null);
    });

    /* ============================================================
     |  OPEN EDIT MODAL
     ============================================================ */
    $(document).on('click', '.btn-edit-company', function () {
        var id = $(this).data('id');

        $('#editCompanyForm')[0].reset();
        $('#edit_user_id').val(id);
        $('#edit_district_id').html('<option value="">-- Select District --</option>');
        $('#edit_upzila_id').html('<option value="">-- Select Upazila --</option>');

        $.ajax({
            url: "{{ route('admin.company-edit-ajax') }}",
            type: "GET",
            data: { id: id },
            dataType: "json",
            success: function (res) {
                if (!res.status) {
                    Swal.fire("Error!", res.msg || "Company not found", "error");
                    return;
                }
                var d = res.data;

                $('#edit_user_id').val(d.user_id);
                $('#edit_company').val(d.company);
                $('#edit_email').val(d.email);
                $('#edit_mobile').val(d.mobile);
                $('#edit_address').val(d.address);

                $('#edit_phone').val(d.phone);
                $('#edit_fax').val(d.fax);
                $('#edit_website').val(d.website);
                $('#edit_zip').val(d.zip);
                $('#edit_b_type').val(d.b_type);
                $('#edit_c_type').val(d.c_type);
                $('#edit_open').val(d.open);
                $('#edit_close').val(d.close);
                $('#edit_tax').val(d.tax);
                $('#edit_expire').val(d.expire);
                $('#edit_sender_id').val(d.sender_id);
                $('#edit_api_key').val(d.api_key);

                // Chain: division → district → upazila
                $('#edit_division_id').val(d.division_id);

                loadDistricts(d.division_id, d.district_id, function () {
                    loadUpazilas(d.district_id, d.upzila_id);
                });

                $('#editCompanyModal').modal('show');
            },
            error: function (xhr) {
                Swal.fire("Error!", "Could not load company data.", "error");
                console.log(xhr.responseText);
            }
        });
    });

    /* ============================================================
     |  FLASH MESSAGES
     ============================================================ */
    @if(session()->has('company_active'))
      Swal.fire("Submited!", "{{ session()->get('company_active') }}", "success");
    @endif
    @if(session()->has('suspend'))
      Swal.fire("Submited!", "{{ session()->get('suspend') }}", "success");
    @endif
    @if(session()->has('unsuspend'))
      Swal.fire("Submited!", "{{ session()->get('unsuspend') }}", "success");
    @endif
    @if(session()->has('company_updated'))
      Swal.fire("Updated!", "{{ session()->get('company_updated') }}", "success");
    @endif
    @if(session()->has('err'))
      Swal.fire("Error!", "{{ session()->get('err') }}", "error");
    @endif
</script>
@endsection
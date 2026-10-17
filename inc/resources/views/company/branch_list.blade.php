
@extends('company.layout.master')

@section('branch_list', 'menu-open')
@section('branch_list_link', 'active')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Branch</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row" id="branch" v-cloak>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Branch List</h3>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Today Order</th>
                                    <th>Total Order</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $sl = 0;
                                @endphp

                                @foreach ($branches as $branche)
                                    @php
                                        $branchDetails = optional($branche->BranchDetails);

                                        $total_order = App\Models\IglTailorAddOrder::where(
                                            'its_add_order_submit_by',
                                            $branche->its_branch_login_id
                                        )
                                            ->distinct('its_add_order_order_id')
                                            ->count('its_add_order_order_id');

                                        $current_date = Carbon\Carbon::now()->format('Y-m-d');

                                        $today_order = App\Models\IglTailorAddOrder::where(
                                            'its_add_order_submit_by',
                                            $branche->its_branch_login_id
                                        )
                                            ->where(
                                                'its_add_order_receive_date',
                                                $current_date
                                            )
                                            ->distinct('its_add_order_order_id')
                                            ->count('its_add_order_order_id');
                                    @endphp

                                    <tr>
                                        <td>{{ ++$sl }}</td>

                                        <td>
                                            {{ $branchDetails->its_username ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $branchDetails->its_mobile ?? 'N/A' }}
                                        </td>

                                        <td>
                                            {{ $branchDetails->its_address ?? 'N/A' }}
                                        </td>

                                        <td>{{ $today_order }}</td>

                                        <td>{{ $total_order }}</td>
                                    </tr>
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

    <style>
        [v-cloak] {
            display: none;
        }
    </style>
@endsection

@section('custom_script')
    <script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('assets/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/js/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script>
        var app = new Vue({
            el: '#branch',
            data: {
                branch: {!! json_encode($branches) !!}
            }
        });

        $(document).ready(function () {
            $('#example1').DataTable({
                responsive: true
            });
        });
    </script>
@endsection

@extends('branch.layout.master')
@section('user_class','menu-open')
@section('user_class_link','active')
@section('user_list','active')
@section('content')
  <section class="content">
    <div class="row px-3">
      <form action="{{ route('branch.user.user-menu-permission-insert') }}" method="post"> 
        @csrf 
        <input type="hidden" name="user_slno"  class="form-control" value="{{ $user_slno }}">
        <div class="col-12 mt-3">
            @php
                $permission_status =explode(',',$user_info->its_user_permission_status);
            @endphp
            <div class="row">
                <div class="col-3">
                    <div class="pb-2">
                        <i style="font-size: 20px;" class="fas fa-file"></i> 
                        <span class="pl-3" style="font-size: 25px;">Buy</span>
                    </div>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">
                            <input type="checkbox" {{ (in_array(1,$permission_status))? 'checked':'' }} data-toggle="toggle" value="1" data-size="mini" name="permission_status[]">
                            <span class="pl-2">Buy</span>
                        </li>
                    </ul>
                </div>
                <div class="col-3">
                    <div class="pb-2">
                        <i style="font-size: 20px;" class="fas fa-file"></i> 
                        <span class="pl-3" style="font-size: 25px;">Sale</span>
                    </div>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">
                            <input type="checkbox"  {{ (in_array(2,$permission_status))? 'checked':'' }} data-toggle="toggle" value="2" data-size="mini" name="permission_status[]">
                            <span class="pl-2">Sale</span>
                        </li>
                    </ul>
                </div>
                <div class="col-3">
                    <div class="pb-2">
                        <i style="font-size: 20px;" class="fas fa-file"></i> 
                        <span class="pl-3" style="font-size: 25px;">Order</span>
                    </div>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">
                            <input type="checkbox" {{ (in_array(3,$permission_status))? 'checked':'' }} data-toggle="toggle" value="3" data-size="mini" name="permission_status[]">
                            <span class="pl-2">Order Now</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="pb-2">
                <i style="font-size: 20px;" class="fas fa-file"></i> 
                <span class="pl-3" style="font-size: 25px;">Order Report</span>
            </div>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(4,$permission_status))? 'checked':'' }}  value="4" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Receive</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(5,$permission_status))? 'checked':'' }}  value="5" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Processing</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(6,$permission_status))? 'checked':'' }}  value="6" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Waiting For Complete</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(7,$permission_status))? 'checked':'' }}  value="7" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Show Order Details</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(8,$permission_status))? 'checked':'' }}  value="8" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Order Lists</span>
                </li>
            </ul>
        </div>
        <div class="col-12 mt-3">
            <div class="pb-2">
                <i style="font-size: 20px;" class="fas fa-file"></i> 
                <span class="pl-3" style="font-size: 25px;">Customer</span>
            </div>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(9,$permission_status))? 'checked':'' }} value="9" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Customer Registration</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(10,$permission_status))? 'checked':'' }} value="10" data-size="mini" name="permission_status[]">
                    <span class="pl-2">All Customers</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(11,$permission_status))? 'checked':'' }} value="11" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Payments</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(12,$permission_status))? 'checked':'' }} value="12" data-size="mini" name="permission_status[]">
                    <span class="pl-2">View Customer Statement</span>
                </li>
            </ul>
        </div>
        <div class="col-12 mt-3">
            <div class="pb-2">
                <i style="font-size: 20px;" class="fas fa-file"></i> 
                <span class="pl-3" style="font-size: 25px;">Worker</span>
            </div>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(13,$permission_status))? 'checked':'' }} value="13" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Maker Registration</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(14,$permission_status))? 'checked':'' }} value="14" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Maker Payment</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(15,$permission_status))? 'checked':'' }} value="15" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Maker Pending Payment</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(16,$permission_status))? 'checked':'' }} value="16" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Statements</span>
                </li>
            </ul>
        </div>
        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-3">
                    <div class="pb-2">
                        <i style="font-size: 20px;" class="fas fa-file"></i> 
                        <span class="pl-3" style="font-size: 25px;">Price Update</span>
                    </div>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">
                            <input type="checkbox"  data-toggle="toggle" {{ (in_array(17,$permission_status))? 'checked':'' }} value="17" data-size="mini" name="permission_status[]">
                            <span class="pl-2">Price Update</span>
                        </li>
                    </ul>
                </div>
                <div class="col-9">
                    <div class="pb-2">
                        <i style="font-size: 20px;" class="fas fa-file"></i> 
                        <span class="pl-3" style="font-size: 25px;">Cost</span>
                    </div>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">
                            <input type="checkbox"  data-toggle="toggle" {{ (in_array(18,$permission_status))? 'checked':'' }} value="18" data-size="mini" name="permission_status[]">
                            <span class="pl-2">Set Making Cost</span>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox"  data-toggle="toggle" {{ (in_array(19,$permission_status))? 'checked':'' }} value="19" data-size="mini" name="permission_status[]">
                            <span class="pl-2">Total Income and Spend</span>
                        </li>
                        <li class="list-group-item">
                            <input type="checkbox"  data-toggle="toggle" {{ (in_array(20,$permission_status))? 'checked':'' }} value="20" data-size="mini" name="permission_status[]">
                            <span class="pl-2">Expend</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="pb-2">
                <i style="font-size: 20px;" class="fas fa-file"></i> 
                <span class="pl-3" style="font-size: 25px;"> Product Information</span>
            </div>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(21,$permission_status))? 'checked':'' }} value="21" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Add Group</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(22,$permission_status))? 'checked':'' }} value="21" data-size="mini" name="permission_status[]">
                    <span class="pl-2">View Group</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(23,$permission_status))? 'checked':'' }} value="22" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Add Product Type</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(24,$permission_status))? 'checked':'' }} value="23" data-size="mini" name="permission_status[]">
                    <span class="pl-2">View Product Type</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(25,$permission_status))? 'checked':'' }} value="24" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Add Product Name</span>
                </li>
            </ul>
            <ul class="list-group list-group-horizontal pt-3">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(26,$permission_status))? 'checked':'' }} value="25" data-size="mini" name="permission_status[]">
                    <span class="pl-2">View Product Name</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(27,$permission_status))? 'checked':'' }} value="26" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Add Location</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(28,$permission_status))? 'checked':'' }} value="27" data-size="mini" name="permission_status[]">
                    <span class="pl-2">View Location</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(29,$permission_status))? 'checked':'' }} value="28" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Add Product</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(30,$permission_status))? 'checked':'' }} value="29" data-size="mini" name="permission_status[]">
                    <span class="pl-2">View Product</span>
                </li>
            </ul>
        </div>
        <div class="col-12 mt-3">
            <div class="pb-2">
                <i style="font-size: 20px;" class="fas fa-file"></i> 
                <span class="pl-3" style="font-size: 25px;">Supplier Information</span>
            </div>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(31,$permission_status))? 'checked':'' }} value="30" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Add Supplier</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(32,$permission_status))? 'checked':'' }} value="31" data-size="mini" name="permission_status[]">
                    <span class="pl-2">View Supplier</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(33,$permission_status))? 'checked':'' }} value="32" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Add Supplier Bank</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(34,$permission_status))? 'checked':'' }} value="34" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Add Payment Date</span>
                </li>
            </ul>
            <ul class="list-group list-group-horizontal mt-3">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(35,$permission_status))? 'checked':'' }} value="35" data-size="mini" name="permission_status[]">
                    <span class="pl-2">View Payment Date</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(36,$permission_status))? 'checked':'' }} value="36" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Supplier Payment</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(37,$permission_status))? 'checked':'' }} value="37" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Supplier Statement</span>
                </li>
            </ul>
        </div>
        <div class="col-12 mt-3">
            <div class="pb-2">
                <i style="font-size: 20px;" class="fas fa-file"></i> 
                <span class="pl-3" style="font-size: 25px;">Bank Details</span>
            </div>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(38,$permission_status))? 'checked':'' }} value="38" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Open Bank Account</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(39,$permission_status))? 'checked':'' }} value="39" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Bank Account List</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(40,$permission_status))? 'checked':'' }} value="40" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Bank Deposit</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(41,$permission_status))? 'checked':'' }} value="41" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Bank WithDraw</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(42,$permission_status))? 'checked':'' }} value="42" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Cash Transfer</span>
                </li>
            </ul>    
            <ul class="list-group list-group-horizontal pt-3">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(43,$permission_status))? 'checked':'' }} value="43" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Bank Statement</span>
                </li>
            </ul>
        </div>
        <div class="col-12 my-3">
            <div class="pb-2">
                <i style="font-size: 20px;" class="fas fa-file"></i> 
                <span class="pl-3" style="font-size: 25px;">Account</span>
            </div>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(44,$permission_status))? 'checked':'' }} value="44" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Account Statement</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(45,$permission_status))? 'checked':'' }} value="45" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Product Buy Statement</span>
                </li>
                <li class="list-group-item">
                    <input type="checkbox"  data-toggle="toggle" {{ (in_array(46,$permission_status))? 'checked':'' }} value="46" data-size="mini" name="permission_status[]">
                    <span class="pl-2">Product Sell Statement</span>
                </li>
            </ul>
        </div>
        <div class="col-12 my-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form> 
    </div>
  </section>
  <style>
      .supplier-border{
        border: 1px solid rgba(0, 0, 0, 0.12);
        padding: 20px 15px;
      }
  </style>
@endsection
@section('custom_style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('custom_script')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
          $('.select2').select2()
        })

        @if(session()->has('permission'))
            Swal.fire(
            "Successfuly",
            "{{ session()->get('permission') }}",
            "success",
            )
        @endif
    </script>
@endsection

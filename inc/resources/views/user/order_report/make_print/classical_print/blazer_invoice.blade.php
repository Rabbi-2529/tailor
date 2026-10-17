<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap.min.css') }}">
    <style>
        .table-bordered td{
            border: 1px solid black;
        }
        .table-bordered thead td{
            border-bottom-width: 1px;
        }
    </style>
</head>
<body>
    <div class="container pt-4">
        <div>Measurement of Blazer. Order Id : {{ $maker_order_info->its_maker_order_order_id }}</div>
        <div>Maker Name : {{ $maker_order_info->maker_name->its_maker_name }}</div>
        <div class="col-12 p-0 pt-2">
            <table class="table table-borderless">
                <tr>
                    <td>{{ $blazer_measure_info->its_blazer_measure_long }}</td>
                    <td>{{ $blazer_measure_info->its_blazer_measure_body }}</td>
                    <td>{{ $blazer_measure_info->its_blazer_measure_shoulder }}</td>
                    <td>{{ $blazer_measure_info->its_blazer_measure_hand_long }}</td>
                    <td>{{ $blazer_measure_info->its_blazer_measure_hand_muhuri }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $blazer_measure_info->its_blazer_measure_belly }}</td>
                    <td colspan="4">{{ $blazer_measure_info->its_blazer_measure_cross_back }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $blazer_measure_info->its_blazer_measure_hip }}</td>
                </tr>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text-right">বুতাম</td>
                        <td>{{ $blazer_measure_info->its_blazer_measure_button_num }}</td>
                  
                        <td class="text-right">নেপেল</td>
                        <td>{{ $blazer_measure_info->its_blazer_measure_nepel }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">ওপেন</td>
                         <td>
                            @if($blazer_measure_info->its_blazer_measure_side == 1)
                                ব্যাক ওপেন
                             @elseif($blazer_measure_info->its_blazer_measure_side == 2)
                                সাইড ওপেন
                             @elseif($blazer_measure_info->its_blazer_measure_side == 3)
                                নো ওপেন
                              @else
                                ব্যাক/সাইড ওপেন
                            @endif
                        </td>

                        <td class="text-right">বেস্ট</td>
                        <td>
                            @if ($blazer_measure_info->its_blazer_measure_best == 1)
                                ডাবল
                             @else
                                সিংগেল
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">নিচে</td>
                        <td>
                            @if ($blazer_measure_info->its_blazer_measure_under == 0)
                                রাউন্ড
                             @else
                                স্ক্য়ার
                            @endif
                        </td>
                        <td class="text-right">কেটালগ নং</td>
                        <td>{{ $blazer_measure_info->its_blazer_measure_catalog_no }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">ব্লেজারের সংখ্যা</td>
                        <td>{{ $blazer_measure_info->its_blazer_product_qty }}</td>
                        
                        <td class="text-right">ডেলিভারি তারিখ</td>
                        <td>{{ $order_info->its_add_order_delivery_date	 }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">অনান্য</td>
                        <td colspan="3">{{ $blazer_measure_info->its_blazer_measure_others }}</td>
                    </tr>
                </thead>
            </table>
            <p>Power By : IGL Web™ Ltd. || 880-1958-666999</p>
         </div>
         <button id="print" class="btn-secondary">Print</button>
    </div>

    <script src="{{ asset('assets/datatable/js/jquery-3.3.1.js') }}"></script>
    <script>
        $(document).on('click','#print',function(){
            var x = document.getElementById("print");
            x.style.display = "none";
            window.print();
            x.style.display = "block";
        })
    </script>
  </body>
</html>


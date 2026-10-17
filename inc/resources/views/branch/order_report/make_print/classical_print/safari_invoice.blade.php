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
        <div>Measurement of Safari. Order Id : {{ $maker_order_info->its_maker_order_order_id }}</div>
        <div>Maker Name : {{ $maker_order_info->maker_name->its_maker_name }}</div>
        <div class="col-12 p-0 pt-2">
            <table class="table table-borderless">
                <tr>
                    <td>{{ $safari_measure_info->its_safari_measure_long }}</td>
                    <td>{{ $safari_measure_info->its_safari_measure_body }}</td>
                    <td>{{ $safari_measure_info->its_safari_measure_shoulder }}</td>
                    <td>{{ $safari_measure_info->its_safari_measure_hand_long }}</td>
                    <td>{{ $safari_measure_info->its_safari_measure_hand_cuff }}</td>
                    <td>{{ $safari_measure_info->its_safari_measure_neck }}</td>

                </tr>
                <tr>
                    <td></td>
                    <td>{{ $safari_measure_info->its_safari_measure_belly }}</td>
                    <td>{{ $safari_measure_info->its_safari_measure_cross_back }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $safari_measure_info->its_safari_measure_hip }}</td>
                </tr>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text-right">বডি লুজ</td>
                        <td>{{ $safari_measure_info->its_safari_measure_body_loose }}</td>    
                        
                        <td class="text-right">পেট লুজ</td>
                        <td>{{ $safari_measure_info->its_safari_measure_belly_loose }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">হিপ লুজ</td>
                        <td>{{ $safari_measure_info->its_safari_measure_hip_loose }}</td>
                        
                        <td class="text-right">কলার সাইজ</td>
                        <td>{{ $safari_measure_info->its_safari_measure_collar_size }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">প্লেট</td>
                        <td>
                            @if ($safari_measure_info->its_safari_measure_plet == 1)
                               বক্স প্লেট
                              @elseif($safari_measure_info->its_safari_measure_plet == 2)
                               সেলাই প্লেট
                              @else
                               সেলাই ছাড়া
                            @endif
                        </td>
                        <td class="text-right">পকেট</td>
                        <td>
                            @if($safari_measure_info->its_safari_measure_pocket == 1)
                                1 টা পকেট
                              @elseif($safari_measure_info->its_safari_measure_pocket == 2)
                                2 টা পকেট
                              @elseif($safari_measure_info->its_safari_measure_pocket == 3)
                                3 টা পকেট
                              @elseif($safari_measure_info->its_safari_measure_pocket == 4)
                                4 টা পকেট
                              @else
                                5 টা পকেট
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">ব্যাক সাইড</td>
                        <td>
                            @if($safari_measure_info->its_safari_measure_back_side == 1)
                                ওপেন
                              @else
                               নো ওপেন
                            @endif
                        </td>
                        <td class="text-right">কলার</td>
                        <td>
                            @if($safari_measure_info->its_safari_measure_collar == 1)
                                শার্ট কলার
                               @elseif($safari_measure_info->its_safari_measure_collar == 2)
                                ব্যান্ড কলার
                              @else
                                ওপেন কলার
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">ইনার পকেট</td>
                        <td>
                            @if($safari_measure_info->its_safari_measure_inner_pocket == 1)
                                হবে
                            @else
                                হবে না
                            @endif
                        </td>
                        <td class="text-right">সাফারি ধরণ</td>
                        <td>
                            @if($safari_measure_info->its_safari_measure_type == 1)
                                ফুল হাতা
                            @else
                                হাফ হাতা
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">কেটালগ নং</td>
                        <td>{{ $safari_measure_info->its_safari_measure_catalog_no }}</td>
                       
                        <td class="text-right">সাফারি সংখ্যা</td>
                        <td>{{ $safari_measure_info->its_safari_product_qty }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">ডেলিভারি তারিখ</td>
                        <td>{{ $order_info->its_add_order_delivery_date	 }}</td>
                   
                        <td class="text-right">অনান্য</td>
                        <td>{{ $safari_measure_info->its_safari_measure_others }}</td>
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


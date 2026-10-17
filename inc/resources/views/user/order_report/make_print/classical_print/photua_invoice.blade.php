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
        <div>Measurement of Photua. Order Id : {{ $maker_order_info->its_maker_order_order_id }}</div>
        <div>Maker Name : {{ $maker_order_info->maker_name->its_maker_name }}</div>
        <div class="col-12 p-0 pt-2">
            <table class="table table-borderless">
                <tr>
                    <td>{{ $photua_measure_info->its_photua_measure_long }}</td>
                    <td>{{ $photua_measure_info->its_photua_measure_body }}</td>
                    <td>{{ $photua_measure_info->its_photua_measure_shoulder }}</td>
                    <td>{{ $photua_measure_info->its_photua_measure_hand_long }}</td>     
                    <td>{{ $photua_measure_info->its_photua_measure_hand_cuff }}</td>
                    <td>{{ $photua_measure_info->its_photua_measure_neck }}</td>    
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $photua_measure_info->its_photua_measure_belly }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $photua_measure_info->its_photua_measure_hip }}</td>
                </tr>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text-right">হাতা কুনু</td>
                        <td>{{ $photua_measure_info->its_photua_measure_hand_kunu }}</td>    
                        
                        <td class="text-right">হাতা মোজা</td>
                        <td>{{ $photua_measure_info->its_photua_measure_hand_moja }}</td>    
                    </tr>
                    <tr>
                        <td class="text-right">বডি লুজ</td>
                        <td>{{ $photua_measure_info->its_photua_measure_body_loose }}</td>
                        
                        <td class="text-right">ধরন</td>
                        <td>
                             @if ($photua_measure_info->its_photua_measure_types == 1)
                                চাইনিজ
                                @elseif($photua_measure_info->its_photua_measure_types == 2)
                                হাওয়াই
                                @else
                                হাফ
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">প্লেট</td>
                        <td>
                            @if ($photua_measure_info->its_photua_measure_plet == 1)
                               বক্স প্লেট
                              @elseif($photua_measure_info->its_photua_measure_plet == 2)
                               সেলাই প্লেট
                              @else
                               সেলাই ছাড়া
                            @endif
                        </td>
                        <td class="text-right">কলার</td>
                        <td>
                            @if ($photua_measure_info->its_photua_measure_collar == 1)
                               এরো
                              @elseif($photua_measure_info->its_photua_measure_collar == 2)
                               টাই
                              @elseif($photua_measure_info->its_photua_measure_collar == 3)
                               বেন
                              @else
                               পাঞ্জাবি
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">কলারের মাপ</td>
                        <td>{{ $photua_measure_info->its_photua_measure_collar_size }}</td>
                        
                        <td class="text-right">কাফ সাইজ</td>
                        <td>{{ $photua_measure_info->its_photua_measure_cuff_size }}</td>
                      
                    </tr>    
                    <tr>
                        <td class="text-right">পকেট</td>
                        <td>
                            @if($photua_measure_info->its_photua_measure_pocket == 1)
                                1 টা পকেট
                              @elseif($photua_measure_info->its_photua_measure_pocket == 2)
                                2 টা পকেট
                              @elseif($photua_measure_info->its_photua_measure_pocket == 3)
                                3 টা পকেট
                              @else
                                4 টা পকেট
                            @endif
                        </td>
                        <td class="text-right">ভিতর পকেট</td>
                        <td>
                            @if($photua_measure_info->its_photua_measure_pocket_inner == 1)
                                পকেট হবে
                              @else
                               পকেট হবে না
                            @endif
                        </td>
                    </tr>    
                        <td class="text-right">ওপেন</td>
                        <td>
                            @if($photua_measure_info->its_photua_measure_open == 1)
                                ওপেন
                              @else
                               নো ওপেন
                            @endif
                        </td>
                        <td class="text-right">কেটালগ নং</td>
                        <td>{{ $photua_measure_info->its_photua_measure_catalog_no }}</td>
                    <tr>
                    <tr>
                        <td class="text-right">ফতুয়া সংখ্যা</td>
                        <td>{{ $photua_measure_info->its_photua_product_qty }}</td>
                        <td class="text-right">ডেলিভারি তারিখ</td>
                        <td>{{ $order_info->its_add_order_delivery_date	 }}</td>                   
                    </tr>
                    <tr>
                        <td class="text-right">অনান্য</td>
                        <td colspan="3">{{ $photua_measure_info->its_photua_measure_others }}</td>
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


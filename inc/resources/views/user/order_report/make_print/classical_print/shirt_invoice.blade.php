<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME") }}</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}">
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
        <div>Measurement of Shirt. Order Id : {{ $maker_order_info->its_maker_order_order_id }}</div>
        <div>Maker Name : {{ $maker_order_info->maker_name->its_maker_name }}</div>
        <div class="col-12 p-0 pt-2">
            <table class="table table-borderless">
                <tr>
                    <td>{{ $shirt_measure_info->its_shirt_msr_long }}</td>
                    <td>{{ $shirt_measure_info->its_shirt_msr_body }}</td>
                    <td>{{ $shirt_measure_info->its_shirt_msr_shoulder }}</td>
                    <td>{{ $shirt_measure_info->its_shirt_msr_hand_long }}</td>
                    <td>{{ $shirt_measure_info->its_shirt_msr_hand_cuff }}</td>
                    <td>{{ $shirt_measure_info->its_shirt_msr_neck }}</td>
                </tr>
                <tr>
                    <td></td>    
                    <td>{{ $shirt_measure_info->its_shirt_msr_bally }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $shirt_measure_info->its_shirt_msr_hip }}</td>
                </tr>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text-right">হাতা মোজা</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_hand_moja }}</td>

                        <td class="text-right">হাতা কুনু</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_hand_kunu }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">বডি লুজ</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_body_loose }}</td>

                        <td class="text-right">পেট লুজ</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_bally_loose }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">হিপ লুজ</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_hip_loose }}</td>

                        <td class="text-right">ধরন</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_types }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">প্লেট</td>
                        <td>
                            @if($shirt_measure_info->its_shirt_msr_plet == 1)
                                 সেলাই প্লেট
                                @elseif($shirt_measure_info->its_shirt_msr_plet == 2)
                                  বক্স প্লেট
                                @elseif($shirt_measure_info->its_shirt_msr_plet == 3)
                                  ইনার প্লেট                                   
                            @endif
                        </td>
                        <td class="text-right">কলার</td>
                        <td>
                            @if($shirt_measure_info->its_shirt_msr_collar == 1)
                                এরো
                              @elseif($shirt_measure_info->its_shirt_msr_pocket == 2)
                                টাই
                              @elseif($shirt_measure_info->its_shirt_msr_pocket == 3)
                                বেন
                              @elseif($shirt_measure_info->its_shirt_msr_pocket == 4)
                                পাঞ্জাবি
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">কলারের মাপ</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_collar_size }}</td>

                        <td class="text-right">কাফ সাইজ</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_cuff_size }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">পকেট</td>
                        <td>
                            @if($shirt_measure_info->its_shirt_msr_pocket == 1)
                                1 টা পকেট
                              @elseif($shirt_measure_info->its_shirt_msr_pocket == 2)
                                2 টা পকেট
                              @elseif($shirt_measure_info->its_shirt_msr_pocket == 3)
                                3 টা পকেট
                              @elseif($shirt_measure_info->its_shirt_msr_pocket == 4)
                                4 টা পকেট
                              @else
                                পকেট হবে না
                            @endif
                        </td>
                        <td class="text-right">ভিতর পকেট</td>
                        <td>
                            @if($shirt_measure_info->its_shirt_msr_pocket_inner == 1)
                                পকেট হবে
                              @else
                                পকেট হবে না
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">কেটালগ নং</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_catalog_no }}</td>
                        
                        <td class="text-right">জামার সংখ্যা</td>
                        <td>{{ $shirt_measure_info->its_shirt_product_qty }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">ডেলিভারি তারিখ</td>
                        <td>{{ $order_info->its_add_order_delivery_date	 }}</td>

                        <td class="text-right">অনান্য</td>
                        <td>{{ $shirt_measure_info->its_shirt_msr_others }}</td>
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


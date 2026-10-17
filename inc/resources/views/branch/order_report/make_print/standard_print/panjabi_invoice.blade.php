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
        <div>Measurement of Panjabi. Order Id : {{ $maker_order_info->its_maker_order_order_id }}</div>
        <div>Maker Name : {{ $maker_order_info->maker_name->its_maker_name }}</div>
        <div class="col-12 p-0 pt-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text-right">লম্বা</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_long }}</td>
                       
                        <td class="text-right">বডি</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_body }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">পেট</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_belly }}</td>
                  
                        <td class="text-right">হিপ</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_hip }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">কাঁধ</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_shoulder }}</td>

                        <td class="text-right">হাতা-লম্বা</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_hand_long }}</td>

                    </tr>
                    <tr>
                        <td class="text-right">মুহুরী</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_muhuri }}</td>
                 
                        <td class="text-right">গলা</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_neck }}</td>
                 
                    </tr>
                    <tr>
                        <td class="text-right">বডি লুজ</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_body_loose }}</td>
                     
                        <td class="text-right">পেট লুজ</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_belly_loose }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">হিপ লুজ</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_hip_loose }}</td>

                        <td class="text-right">কলার সাইজ</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_collar_size }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">কলার টাইপ</td>
                        <td>
                            @if ($panjabi_measure_info->its_panjabi_msr_collar_type == 1)
                               ব্যান্ড কলার
                            @endif
                        </td>
                        <td class="text-right">পকেট</td>
                        <td>
                            @if($panjabi_measure_info->its_panjabi_msr_pocket == 1)
                                1 টা পকেট
                              @elseif($panjabi_measure_info->its_panjabi_msr_pocket == 2)
                                2 টা পকেট
                              @elseif($panjabi_measure_info->its_panjabi_msr_pocket == 3)
                                3 টা পকেট
                              @elseif($panjabi_measure_info->its_panjabi_msr_pocket == 4)
                                4 টা পকেট
                              @else
                                পকেট হবে না
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">প্লেট</td>
                        <td>
                            @if($panjabi_measure_info->its_panjabi_msr_plet == 1)
                                ইনার প্লেট
                              @else
                                নরমাল প্লেট
                            @endif
                        </td>
                        <td class="text-right">ইনার পকেট</td>
                        <td>
                            @if($panjabi_measure_info->its_panjabi_msr_inner_pocket == 1)
                                হবে
                              @else
                                হবে না
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">কেটালগ নং</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_catalog_no }}</td>
                       
                        <td class="text-right">পাঞ্জাবি সংখ্যা</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_product_qty }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">ডেলিভারি তারিখ</td>
                        <td>{{ $order_info->its_add_order_delivery_date	 }}</td>
                        
                        <td class="text-right">অনান্য</td>
                        <td>{{ $panjabi_measure_info->its_panjabi_msr_others }}</td>
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


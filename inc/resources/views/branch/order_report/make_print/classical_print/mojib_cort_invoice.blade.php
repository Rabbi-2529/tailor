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
        <div>Measurement of Mojib Cort. Order Id : {{ $maker_order_info->its_maker_order_order_id }}</div>
        <div>Maker Name : {{ $maker_order_info->maker_name->its_maker_name }}</div>
        <div class="col-12 p-0 pt-2">
            <table class="table table-borderless">
                <tr>
                    <td>{{ $mojibcort_measure_info->its_mojibcort_measure_long }}</td>
                    <td>{{ $mojibcort_measure_info->its_mojibcort_measure_body }}</td>
                    <td>{{ $mojibcort_measure_info->its_mojibcort_measure_shoulder }}</td>
                    <td>{{ $mojibcort_measure_info->its_mojibcort_measure_neck }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $mojibcort_measure_info->its_mojibcort_measure_belly }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>{{ $mojibcort_measure_info->its_mojibcort_measure_hip }}</td>
                </tr>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text-right">বডি লুজ</td>
                        <td>{{ $mojibcort_measure_info->its_mojibcort_measure_body_loose }}</td>
                     
                        <td class="text-right">পেট লুজ</td>
                        <td>{{ $mojibcort_measure_info->its_mojibcort_measure_belly_loose }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">হিপ লুজ</td>
                        <td>{{ $mojibcort_measure_info->its_mojibcort_measure_hip_loose }}</td>

                        <td class="text-right">কলার</td>
                        <td>
                            @if ($mojibcort_measure_info->its_mojibcort_measure_collar == 1)
                                ব্যান্ড কলার
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">পকেট</td>
                        <td>
                            @if($mojibcort_measure_info->its_mojibcort_measure_pocket == 1)
                                1 টা পকেট
                              @elseif($mojibcort_measure_info->its_mojibcort_measure_pocket == 2)
                                2 টা পকেট
                              @elseif($mojibcort_measure_info->its_mojibcort_measure_pocket == 3)
                                3 টা পকেট
                              @elseif($mojibcort_measure_info->its_mojibcort_measure_pocket == 4)
                                4 টা পকেট
                            @endif
                        </td>
                        <td class="text-right">ইনার পকেট</td>
                        <td>
                            @if($mojibcort_measure_info->its_mojibcort_measure_inner_pocket == 1)
                                হবে
                              @else
                               হবে না
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">ওপেন</td>
                        <td>
                            @if($mojibcort_measure_info->its_mojibcort_measure_open == 1)
                                ব্যাক ওপেন
                              @else
                                সাইড ওপেন
                            @endif
                        </td>
                        <td class="text-right">কেটালগ নং</td>
                        <td>{{ $mojibcort_measure_info->its_mojibcort_measure_catalog_no }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">সংখ্যা</td>
                        <td>{{ $mojibcort_measure_info->its_mojibcort_product_qty }}</td>
                        <td class="text-right">ডেলিভারি তারিখ</td>
                        <td>{{ $order_info->its_add_order_delivery_date	 }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">অনান্য</td>
                        <td colspan="3">{{ $mojibcort_measure_info->its_mojibcort_measure_others }}</td>
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


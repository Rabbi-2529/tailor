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
        <div>Measurement of Payjama. Order Id : {{ $maker_order_info->its_maker_order_order_id }}</div>
        <div>Maker Name : {{ $maker_order_info->maker_name->its_maker_name }}</div>
        <div class="col-12 p-0 pt-2">
            <table class="table table-borderless">
                <tr>
                    <td>{{ $payjama_measure_info->its_payjama_measure_long }}</td>
                    <td>{{ $payjama_measure_info->its_payjama_measure_komor }}</td>
                    <td>{{ $payjama_measure_info->its_payjama_measure_hip }}</td>
                    <td>{{ $payjama_measure_info->its_payjama_measure_muhuri }}</td>
                    <td>{{ $payjama_measure_info->its_payjama_measure_thigh }}</td>
                    <td>{{ $payjama_measure_info->its_payjama_measure_fly }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="4"></td>
                    <td>{{ $payjama_measure_info->its_payjama_measure_high }}</td>
                </tr>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text-right">হিপ লুস</td>
                        <td>{{ $payjama_measure_info->its_payjama_measure_hip_loose }}</td>
                        <td class="text-right">পকেট</td>
                        <td>
                            @if ($payjama_measure_info->its_payjama_measure_pocket == 1)
                                1টি
                             @elseif($payjama_measure_info->its_payjama_measure_pocket == 2)
                                2টি
                             @else
                                3টি
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">পাজামা সংখ্যা</td>
                        <td>{{ $payjama_measure_info->its_payjama_product_qty }}</td>
                        <td class="text-right">ক্যাটালগ নং</td>
                        <td>{{ $payjama_measure_info->its_payjama_measure_catalog_no }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">ডেলিভারি তারিখ</td>
                        <td>{{ $order_info->its_add_order_delivery_date	 }}</td>
                        
                        <td class="text-right">অনান্য</td>
                        <td>{{ $payjama_measure_info->its_payjama_measure_others }}</td>
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


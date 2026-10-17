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
        .text-color td{
            color: black;
            font-weight: 500;
        }
        body{
            font-size: 14px;
        }
        .table-bordered td{
            border: 1px solid black;
            padding: 2px 10px;
        }
        .table-bordered th{
            border: 1px solid black;
            padding: 2px 10px;
        }
        .table-bordered thead th{
            border-bottom-width: 1px;
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container pt-4">
        <div class="col-12">
            <div class="row pb-2">
                <div class="col-4">
                    <img  src="{{ asset($branch_information->its_branch_com_logo) }}" alt="Not Found" class="img-fluid" style="width:100px; height:100px;">
                </div>
                <div class="col-4 text-center">
                     <h3>{{ $login_information->its_username }} </h3>   
                     <div>{{ $login_information->its_address }}</div>   
                     <div>{{ $login_information->its_email }}</div>   
                </div>
                <div class="col-4 text-right">
                    <div>Mobile: {{ $login_information->its_mobile }}</div>
                    <div>Phone:  </div>
                </div>
            </div>
            <div class="row pb-2">
                <div class="col-4">
                    <div>Name: {{ $single_order_info->customer_name->its_cus_name }}</div>
                    <div>Mobile: {{ $single_order_info->customer_name->its_cus_mobile }}</div>
                </div>
                <div class="col-4 text-center">
                    <div>Receive Date: {{ $single_order_info->its_add_order_receive_date }}</div>   
                    <div>Delivery Date: {{ $single_order_info->its_add_order_delivery_date }}</div>   
                </div>
                <div class="col-4 text-right">
                    <div>Order ID: {{ $single_order_info->its_add_order_order_id }}</div>
                    <div>Receiver: Branch</div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-color">
                        <th style="width: 10%;" class="text-center">SL</th>
                        <th style="width: 20%;">Product Name</th>
                        <th style="width: 5%;">Quantity</th>
                        <th style="width: 15%;">Price</th>
                        <th style="width: 20%;" class="text-right">Total Price</th>
                        <th style="width: 35%;" class="text-center">Sample</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $sl = 0
                    @endphp
                    @foreach ($order_inform as $order)
                        @php
                            $total += $order->its_add_order_total_price;
                        @endphp
                       <tr>
                            <td class="text-center">{{ ++$sl }}</td>
                            <td>{{ $order->its_add_product_name }}</td>
                            <td class="text-center">{{ $order->its_add_product_quantity }}</td>
                            <td>{{ $order->its_add_product_price }}</td>
                            <td class="text-right">{{ $order->its_add_order_total_price }}<span>.00</span></td>
                            <colgroup span="1"></colgroup>
                       </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <th class="text-right" colspan="3">Total Amount</th>
                        <th class="text-right">{{ $total }}<span>.00</span></th>
                        <colgroup span="1"></colgroup>
                    </tr>
                    <tr>
                        <td class="text-center">{{ ++$sl }}</td>
                        <td colspan="5">
                            Total in word :  {{ App\Models\NumberConverter::number_to_text($total) }}
                        </td>
                        
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                     <br>
                     <span  style="border-top:2px solid black">Signature By</span>
                </div>
                <div class="col-6 font-weight-bold">
                     Total due: {{ $total_due }}<span>.00</span> Tk   
                </div>
            </div>
            
            <div class="row m-0">
                <div class="col-3">
                   
                </div>
                <div class="col-9">
                   <p style="font-size: 15px;margin-bottom:0px">Power By : <span class="font-weight-bold">IGL Web™ Ltd.</span> || 880-1958-666999</p>
                </div>
            </div>
            <button id="print" class="btn-secondary">Print</button>
         </div>
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


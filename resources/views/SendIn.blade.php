<html>
@php
    $order_id = 1;
      $customer = \App\Models\OrderBillingDetails::whereOrderId($order_id)->firstOrFail();
      $products = \App\Models\OrderProductsDetails::whereOrderId($order_id)->get();
      $order = \App\Models\Order::findOrFail($order_id);
      $t = time()
@endphp

<body
    style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
<table
    style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px darkred;">
    <thead>
    <tr>
        <th style="text-align:left;"><img style="max-width: 150px;" src="javascript:void(0)"
                                          alt="ToHoney"></th>
        <th style="text-align:right;font-weight:400;">{{now()->format('d-m-Y')}}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="height:35px;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
            <p style="font-size:14px;margin:0 0 6px 0;"><span
                    style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b
                    style="color:green;font-weight:normal;margin:0">Process</b></p>
            <p style="font-size:14px;margin:0 0 6px 0;"><span
                    style="font-weight:bold;display:inline-block;min-width:146px">Transaction ID</span> {{'Cus_'.$order_id.'$'.$t}}
            </p>
            <p style="font-size:14px;margin:0 0 0 0;"><span
                    style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span>
                BDT.{{$order->subtotal-$order->subtotal/100*$order->discount}}</p>
        </td>
    </tr>
    <tr>
        <td style="height:35px;"></td>
    </tr>
    <tr>
        <td style="width:50%;padding:20px;vertical-align:top">
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                    style="display:block;font-weight:bold;font-size:13px">Name</span> {{$customer->customer_name}}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                    style="display:block;font-weight:bold;font-size:13px;">Email</span> {{$customer->customer_email}}
            </p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                    style="display:block;font-weight:bold;font-size:13px;">Phone</span>{{$customer->phone_number}}</p>
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                    style="display:block;font-weight:bold;font-size:13px;">ID No.</span> {{$customer->order_id}}</p>
        </td>
        <td style="width:50%;padding:20px;vertical-align:top">
            <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                    style="display:block;font-weight:bold;font-size:13px;">Address</span>{{$customer->address}}</p>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Items</td>
    </tr>
    <tr>
        <td colspan="2" style="padding:15px;">
            @foreach($products as $product)
                <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                    <span style="display:block;font-size:13px;font-weight:normal;">{{$product->product_name}}</span>
                    BDT. {{$product->product_price}} <b
                        style="font-size:12px;font-weight:300;">(Quantity:{{$product->product_quantity}})</b>
                </p>
            @endforeach
        </td>
    </tr>
    </tbody>
    <tfooter>
        <tr>
            <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                <strong style="display:block;margin:0 0 10px 0;">Regards</strong> Tohoney<br> Mitford
                Rd,Dhaka-1100<br><br>
                <b>Phone:</b>+8801307997323<br>
                <b>Email:</b> contact@tohoney.bd
            </td>
        </tr>
    </tfooter>
</table>
</body>

</html>


{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Invoice</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"--}}
{{--          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}

{{--    <style>--}}
{{--        * {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--        }--}}

{{--        ol, ul, li {--}}
{{--            list-style: none;--}}
{{--            font-weight: bold;--}}

{{--        }--}}
{{--    </style>--}}

{{--</head>--}}

{{--<body>--}}

{{--@php--}}

{{--    $order_id = 1;--}}
{{--      $customer = \App\Models\OrderBillingDetails::whereOrderId($order_id)->firstOrFail();--}}
{{--      $products = \App\Models\OrderProductsDetails::whereOrderId($order_id)->get();--}}
{{--      $order = \App\Models\Order::findOrFail($order_id);--}}
{{--      $t = time()--}}

{{--@endphp--}}
{{--<div class="container mt-5">--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-10">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header text-center"><h2>Your Orders</h2></div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <ul>--}}
{{--                                <li> Time: {{now()->format('h:i:a,d-m-Y')}}</li>--}}
{{--                                <li>Serial_Number: {{'Cus_'.$order_id.'$'.$t}}</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <ul>--}}
{{--                                <li>Customer Name: {{$customer->customer_name}}</li>--}}
{{--                                <li> Customer Email: {{$customer->customer_email}}</li>--}}
{{--                                <li>Customer Phone: {{$customer->phone_number}}</li>--}}
{{--                                <li>Customer Address: {{$customer->address}}</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row mt-2">--}}
{{--                        <div class="col-lg-12 m-auto">--}}
{{--                            <table class="table table-striped text-center">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Order_Number</th>--}}
{{--                                    <th>Product_Name</th>--}}
{{--                                    <th>Product_Quantity</th>--}}
{{--                                    <th>Product_Price</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($products as $i=> $product)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$i+1}}</td>--}}
{{--                                        <td>{{$product->product_name}}</td>--}}
{{--                                        <td>{{$product->product_quantity}}</td>--}}
{{--                                        <td>{{$product->product_price.'৳'}}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                <tr>--}}
{{--                                    <td colspan="2"></td>--}}
{{--                                    <td class="fw-bold">SubTotal</td>--}}
{{--                                    <td class="fw-bold">{{$order->subtotal}} BDT</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td colspan="2"></td>--}}
{{--                                    <td class="fw-bold">Discount</td>--}}
{{--                                    <td class="fw-bold">(-) {{$order->discount}}%</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td colspan="2"></td>--}}
{{--                                    <td class="fw-bold">Total</td>--}}
{{--                                    <td class="fw-bold">{{$order->subtotal-$order->subtotal/100*$order->discount}} BDT</td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-lg-12">--}}
{{--                                    @php--}}
{{--                                        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);--}}
{{--                                      $word = $f->format($order->total);--}}
{{--                                    @endphp--}}
{{--                                    {{strtoupper('IN Word: '.$word.'  Taka ONLY.')}}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"--}}
{{--        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"--}}
{{--        crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"--}}
{{--        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"--}}
{{--        crossorigin="anonymous">--}}

{{--</script>--}}

{{--</body>--}}
{{--</html>--}}


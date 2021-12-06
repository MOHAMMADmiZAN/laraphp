<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        ol, ul, li {
            list-style: none;
            font-weight: bold;

        }
    </style>
    <td></td>

</head>

<body>
@php
    $customer = \App\Models\OrderBillingDetails::whereOrderId($order_id)->firstOrFail();
    $products = \App\Models\OrderProductsDetails::whereOrderId($order_id)->get();
    $order = \App\Models\Order::findOrFail($order_id);

@endphp
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header text-center"><h2>Your Orders</h2></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul>
                                <li> Date: {{now()->format('Y-m-d')}}</li>
                                <li>Serial_Number: {{'Cus_'.$order_id}}</li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul>
                                <li>Customer Name: {{$customer->customer_name}}</li>
                                <li> Customer Email: {{$customer->customer_email}}</li>
                                <li>Customer Phone: {{$customer->phone_number}}</li>
                                <li>Customer Address: {{$customer->address}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-8 m-auto">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Order_Number</th>
                                    <th>Product_Name</th>
                                    <th>Product_Quantity</th>
                                    <th>Product_Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->order_id}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->product_quantity}}</td>
                                        <td>{{$product->product_price}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2"></td>
                                    <td>SubTotal</td>
                                    <td>{{$order->subtotal}} BDT</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Discount</td>
                                    <td>(-){{$order->discount}} %</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Total</td>
                                    <td>{{$order->total}} BDT</td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-lg-12">
                                    @php
                                        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                      $word = $f->format($order->total);
                                    @endphp
                                    {{strtoupper('Note: '.$word.'  Taka ONLY.')}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>

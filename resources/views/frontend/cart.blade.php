@extends('frontend.view')
@section('frontend_content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index-2.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="">
                        <table class="table-responsive cart-wrap">
                            <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $subtotal = 0;
                            @endphp

                            @foreach($cart_products as $cart)
                                <tr>
                                    <td class="images"><img
                                            src="{{asset('assets/dist/upload/products/'.$cart->product->product_photo)}}"
                                            alt="{{$cart->product->product_photo}}"></td>
                                    <td class="product"><a
                                            href="{{route('single',[$cart->product_id])}}">{{$cart->product->product_name}}</a>
                                    </td>
                                    <td class="price">${{$cart->product->product_price}}</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" value="{{$cart->product_quantity}}"/>
                                    </td>
                                    <td class="total">${{$cart->product->product_price*$cart->product_quantity}}</td>
                                    <td class="remove"><a href="{{route('cart_deleted',$cart->id)}}"><i
                                                class="fa fa-times"></i></a></td>
                                </tr>
                                @php
                                    $subtotal = $subtotal+$cart->product->product_price*$cart->product_quantity
                                @endphp

                            @endforeach

                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="shop.html">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Coupon Code" id="coupon-code">
                                        <a id="apply_code"
                                           style="padding: 10px 30px;position: absolute;right: 0;top: 0;background: #ef4836;color: #fff;text-transform: uppercase;border: none;margin: 0;font-family: inherit;font-size: inherit;line-height: inherit; cursor: pointer">Apply
                                            Coupon</a>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>${{$subtotal}}</li>
                                        <li><span
                                                class="pull-left">Discount(<small>{{$discount.'%'}}</small>)</span>${{$discount=$subtotal/100*$discount}}
                                        </li>
                                        <li><span class="pull-left"> Total </span>${{$subtotal-$discount}}</li>
                                    </ul>
                                    <a href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
    <script>
        let apply_coupon = document.querySelector('#apply_code');
        apply_coupon.addEventListener('click', function (e) {
            e.preventDefault()
            let coupon_code = document.querySelector('#coupon-code')
            let coupon = coupon_code.value
            window.location.href = `{{url('/cart_coupon')}}/${coupon}`
        })
    </script>


@endsection

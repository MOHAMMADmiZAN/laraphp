@extends('frontend.view')
@section('frontend_content')
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index-2.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    @auth
        <div class="checkout-area ptb-100">
            @php
                $subtotal = 0
            @endphp
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-form form-style">
                            <h3>Billing Details</h3>
                            <form>
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <p>First Name *</p>
                                        <input type="text" value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Email Address *</p>
                                        <input type="email" value="{{Auth::user()->email}}">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Phone No. *</p>
                                        <input type="text" id="phone">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Country *</p>

                                        <label for="country"></label><select name="country" id="country">
                                            <option value=>Select One</option>
                                            @forelse($countries as $country)
                                                <option value={{$country->id}}>{{$country->name}}</option>
                                            @empty
                                                <p>No Country</p>

                                            @endforelse

                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Town/City *</p>
                                        <select name="city" id="city">
                                            <option value=>Select One</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Postcode/ZIP</p>
                                        <input type="email">
                                    </div>
                                    <div class="col-12">
                                        <p>Your Address *</p>
                                        <input type="text">
                                    </div>


                                    <div class="col-12">
                                        <input id="toggle1" type="checkbox">
                                        <label for="toggle1">Pure CSS Accordion</label>
                                        <div class="create-account">
                                            <p>Create an account by entering the information below. If you are a
                                                returning
                                                customer please login at the top of the page.</p>
                                            <span>Account password</span>
                                            <input type="password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input id="toggle2" type="checkbox">
                                        <label class="fontsize" for="toggle2">Ship to a different address?</label>
                                        <div class="row" id="open2">
                                            <div class="col-12">
                                                <p>Country</p>
                                                <select id="s_country">
                                                    <option value="1">Select a country</option>
                                                    <option value="2">bangladesh</option>
                                                    <option value="3">Algeria</option>
                                                    <option value="4">Afghanistan</option>
                                                    <option value="5">Ghana</option>
                                                    <option value="6">Albania</option>
                                                    <option value="7">Bahrain</option>
                                                    <option value="8">Colombia</option>
                                                    <option value="9">Dominican Republic</option>
                                                </select>
                                            </div>
                                            <div class=" col-12">
                                                <p>First Name</p>
                                                <input id="s_f_name" type="text"/>
                                            </div>
                                            <div class=" col-12">
                                                <p>Last Name</p>
                                                <input id="s_l_name" type="text"/>
                                            </div>
                                            <div class="col-12">
                                                <p>Company Name</p>
                                                <input id="s_c_name" type="text"/>
                                            </div>
                                            <div class="col-12">
                                                <p>Address</p>
                                                <input type="text" placeholder="Street address"/>
                                            </div>
                                            <div class="col-12">
                                                <input type="text"
                                                       placeholder="Apartment, suite, unit etc. (optional)"/>
                                            </div>
                                            <div class="col-12">
                                                <p>Town / City </p>
                                                <input id="s_city" type="text" placeholder="Town / City"/>
                                            </div>
                                            <div class="col-12">
                                                <p>State / County </p>
                                                <input id="s_county" type="text"/>
                                            </div>
                                            <div class="col-12">
                                                <p>Postcode / Zip </p>
                                                <input id="s_zip" type="text" placeholder="Postcode / Zip"/>
                                            </div>
                                            <div class="col-12">
                                                <p>Email Address </p>
                                                <input id="s_email" type="email"/>
                                            </div>
                                            <div class="col-12">
                                                <p>Phone </p>
                                                <input id="s_phone" type="text" placeholder="Phone Number"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p>Order Notes </p>
                                        <textarea name="massage"
                                                  placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order-area">
                            <h3>Your Order</h3>
                            <ul class="total-cost">
                                @foreach($carts as $cart)
                                    <li>{{$cart->product->product_name}}<span
                                            class="pull-right">${{$cart->product->product_price*$cart->product_quantity}}</span>
                                    </li>
                                    @php
                                        $subtotal=$subtotal+$cart->product->product_price*$cart->product_quantity
                                    @endphp

                                @endforeach

                                <li>Subtotal <span
                                        class="pull-right" id="sub_total"
                                        data-subtotal="{{$subtotal}}"><strong>${{$subtotal}}</strong></span>
                                </li>
                                <li>Discount(<small>{{$discount.'%'}}</small>)<span
                                        class="pull-right"
                                        id="discount"
                                        data-discount="{{$discount}}">{{'$'.$discount_amount=$subtotal/100*$discount}}</span>
                                </li>
                                <li>Shipping <span class="pull-right">Free</span></li>
                                <li>Total<span class="pull-right"
                                               id="total"
                                               data-total="{{$total=$subtotal-$discount_amount}}">${{$total=$subtotal-$discount_amount}}</span>
                                </li>
                            </ul>
                            <ul class="payment-method">

                                <li>
                                    <input id="card" type="checkbox" class="payment_online"
                                           value="2">
                                    <label for="card">online Payment</label>
                                </li>
                                <li>
                                    <input id="delivery" type="checkbox" value="1"
                                           class="payment_cash">
                                    <label for="delivery">Cash on Delivery</label>
                                </li>
                            </ul>
                            <button id="place_order">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout-area end -->
    @endauth
    @guest
        <div class="alert alert-info text-center mb-0"><a href="{{route('login')}}">Please Login</a></div>
    @endguest


@endsection
@section('js')

    <script>
        const country = $('#country')
        const city = $('#city');
        const phone = document.querySelector('#phone');
        $(document).ready(function () {
            country.select2()
            city.select2()
            $(".select2-selection").css({
                "width": "100%",
                "height": "40px",
                "border": "1px solid #d7d7d7",
                "text-transform": "none",
                "font-family": "inherit",
                "font-size": "inherit",
                "line-height": "inherit"

            });
            $(".select2-selection__rendered").css({
                "padding-left": "20px",
                "padding-top": "5px",
            })
            // axios alternative is javascript fetch api or core XMLHttpRequest
            country.change((e) => {
                const value = e.target.value
                let phoneurl = `{{url('/get-phone')}}/${value}`

                axios.get(phoneurl).then(function (response) {
                    phone.value = response.data
                }).catch(function (err) {
                    console.log(err.toJSON())
                })
                const url = "{{route('city')}}"
                const data = {
                    country_id: value,
                }
                const config = {
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"

                    }
                }
                axios.post(url, data, config).then(function (response) {
                    city.html(response.data)
                }).catch(function (error) {
                    console.log(error.toJSON());
                });

                //257 to 266 number line gust for api testing
                // let ipp = ''
                // axios.get(`https://api.ipify.org?format=json`).then(function (response) {
                //     ipp = response.data.ip
                //     console.log(ipp)
                //     return ipp
                //
                // })
                // axios.get(`https://geo.ipify.org/api/v2/country,city?apiKey=at_vQ00MT3kIfFDsUkRUuGGnneTeTfQD&ipAddress=${ipp}`).then(function (response) {
                //     console.log(response.data.location.region)
                // })

            })
        });
    </script>
    <script>
        let order = document.getElementById('place_order')
        let sub_total = document.getElementById('sub_total').getAttribute('data-subtotal')
        let total = document.getElementById('total').getAttribute('data-total')
        let discount = document.getElementById('discount').getAttribute('data-discount')
        let payment_cash = document.querySelector('.payment_cash');
        let payment_online = document.querySelector('.payment_online');


        order.addEventListener('click', (e) => {
            let pay

            if (payment_online.checked === true) {
                pay = payment_online.value

            } else if (payment_cash.checked === true) {
                pay = payment_cash.value
            } else {
                pay = '';
            }
            const order_url = "{{route('order_submit')}}"
            const order_data = {
                sub_total: sub_total,
                total: total,
                discount: discount,
                payment_method: pay,
            }
            const config = {
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"

                }
            }
            console.log(order_data)
            axios.post(order_url, order_data, config).then((r) => {
                if (r.status === 200) {

                }
            }).catch((e) => {
                console.log(e)
            })
        })
    </script>
@endsection

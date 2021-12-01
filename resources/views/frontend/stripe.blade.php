<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            padding: 16px;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row m-auto">
        <div class="col-lg-6">
            <div class="card text-center">
                <div class="card-header"><h6>Pay With Stripe</h6></div>
                <div class="card-body">
                    <form action="{{route('stripe-pay_post')}}" id="payment_form" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control my-3 py-2" id="c_name"
                                   placeholder="Card Holder Name" name="card_holder_name">
                        </div>
                        <input type="hidden" name="__totals" id="total_amount">
                        <input type="hidden" name="__Order_Description" id="description">
                        <div id="payment-card">
                        </div>
                        <div id="card-errors" role="alert"></div>
                        <button class="btn pay_now mt-3" style="background: rgba(0, 0, 0, .125);" type="submit"><h6>
                                Pay-Now</h6>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<script>
    (function () {
            let stripe = Stripe("{{env('STRIPE_KEY')}}");
            let elements = stripe.elements()
            // Create an instance of the card Element
            let card = elements.create('card', {
                hidePostalCode: true,
            });
            // Add an instance of the card Element into the `card-element` <div>


            card.mount('#payment-card');
            document.querySelector('.pay_now').innerHTML = `Pay-Now ($${Math.floor(sessionStorage.getItem('Total') / 85)}) `
            document.getElementById("total_amount").setAttribute('value', sessionStorage.getItem('Total'));
            document.getElementById("description").setAttribute('value', sessionStorage.getItem('Description'));
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function (event) {
                let displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            let payment_form = document.getElementById('payment_form');
            sessionStorage.clear()
            payment_form.addEventListener('submit', function (e) {
                e.preventDefault();
                // Disable the submit button to prevent repeated clicks
                document.querySelector('.pay_now').disabled = true;

                let options = {
                    name: document.querySelector('#c_name').value,
                    total_amount: document.querySelector('#total_amount').value,
                    description: document.querySelector('#description').value,
                }

                stripe.createToken(card, options).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        let errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        // Enable the submit button
                        document.getElementById('complete-order').disabled = false;

                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                }).catch(function (error) {
                    console.log(error)
                });
            })

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                let form = document.getElementById('payment_form');
                let hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                // Submit the form
                form.submit();
            }

        }
    )()

</script>
</body>
</html>

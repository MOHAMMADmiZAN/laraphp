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
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card text-center">
                <div class="card-header">Stripe</div>
                <div class="card-body">
                    <div id="payment-card">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<script>
    let stripe = Stripe("{{env('STRIPE_KEY')}}");
    let elements = stripe.elements()
    let payment_card = elements.create('card')
    payment_card.mount('#payment-card',)
    console.log(elements.getElement('card'))
</script>
</body>
</html>

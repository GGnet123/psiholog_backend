<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Video Call -- Agora</title>
    <link rel="stylesheet" href="/sample/video_call/assets/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <form id="paymentFormSample" autocomplete="off" >
                        <input type="text" data-cp="cardNumber" value="4111 1111 1111 1111">
                        <input type="text" data-cp="expDateMonth" value="12">
                        <input type="text" data-cp="expDateYear" value="24">
                        <input type="text" data-cp="cvv" value="988">
                        <input type="text" data-cp="name" value="asdasd">
                        <button type="submit">Оплатить 100 р.</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://checkout.cloudpayments.ru/checkout.js"></script>
<script>

    const checkout = new cp.Checkout({
        publicId: 'pk_6840c67f9779f41238f7c82ff236f',
        container: document.getElementById("paymentFormSample")
    });


    checkout.createPaymentCryptogram()
        .then((cryptogram) => {
            console.log(cryptogram, 222); // криптограмма
        }).catch((errors) => {
        console.log(errors)
    });
</script>
</body>
</html>

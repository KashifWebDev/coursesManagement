<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div id="paypal-button-container"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AfCYO-690TOTak5bLJ9lxaw-a7nY-8SBFID1X7a6Cmoyw2X4j79OMSm7ZDp_6oj218W5YKF19qqgWW0Y&currency=CAD&disable-funding=credit,card"></script>
<script>
            var price = parseFloat('25.00');


            if (price > 0) {

                paypal.Buttons({
                    onInit: function(data, actions) {
                        actions.disable();

                        document.querySelector('#txtUserEmail')
                            .addEventListener('change', function(event) {

                                var val = $.trim(event.target.value);

                                if (val) {
                                    actions.enable();
                                } else {
                                    actions.disable();
                                }
                            });

                    },
                    onClick: function() {

                        var val = $.trim($("#txtUserEmail").val());

                        if (val!=="ok") {
                            alert("Please enter the email");
                        }
                    },
                    createOrder: function(data, actions) {
                        // This function sets up the details of the transaction, including the amount and line item details.
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: price
                                },
                                custom_id: '21'

                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        // This function captures the funds from the transaction.
                        return actions.order.capture().then(function(details) {

                            if (data.orderID) {

                                var payment = {
                                    gateway: 'paypal',
                                    order_id: data.orderID,
                                    amount_total: price,
                                    amount_paid: details.purchase_units[0].payments.captures[0].amount.value,
                                    details: details,
                                    data: data
                                };

                                $("#fmPayment input[name='payment_data']").val(JSON.stringify(payment));
                                $("#fmPayment").submit();
                            }

                        });
                    }
                }).render('#paypal-button-container');

                $("#cardPayment").removeClass('d-none');
            }

</script>
</body>
</html>
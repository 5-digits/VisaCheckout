<html>
<head>
<!-- Visa Checkout JavaScript function -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
function onVisaCheckoutReady() {


  V.init( {
    apikey: "42TD3SKIK62N6C89LDSD13W2kI9qtngtWRF6IWeQme5yvNpuQ",
   //  paymentRequest:{
   //  	currencyCode: "USD",
   //  	total: "10.00"
  	// }
    settings: {
      logoUrl: "http://demo.visacheckout.com/presidio/wp-content/uploads/2014/09/logo.png"
    }
  });
  V.on("payment.success", function(payment) {
    document.write(JSON.stringify(payment));

    $.ajax({
      type: 'POST',
      url: 'Decrypt.php',
      data: {json: JSON.stringify(payment)},
      dataType: 'json'
    });

    // var str_json = "json_string=" + (JSON.stringify(payment))

    // request = new XMLHttpRequestObject()

    // request.open("POST", "Decrypt.php", true)

    // request.setRequestHeader("Content-type", "application/json")

    // request.send(str_json)

  });

  V.on("payment.cancel", function(payment)
  {alert(JSON.stringify(payment)); });
  V.on("payment.error", function(payment, error)
  {alert(JSON.stringify(error)); });
}	


</script>
</head>
<body>
<!-- Visa Checkout button img tag -->
<img class="v-button" role="button" tabindex="0" src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png" alt="Visa Checkout" />
<!-- Visa Checkout SDK -->
<script src="https://sandbox-assets.secure.checkout.visa.com/checkout-widget/resources/js/integration/v1/sdk.js" type="text/javascript"></script>
</body>
</html>



# Card payment example
This is a template for you to use in your own projects for processing card payments with PayWithCapture PHP.
PayWithCapture API can charge Visa, MasterCard and Verve cards. What you need to note is that different
cards have different validation methods which I will discuss below.

```PHP
use PayWithCapture\PayWithCaptureClient;

//You can find your clientId, $clientSecret in your PayWithCapture DevCenter settings page
$clientId = "745474656hdhdgftfyfjfkg";
$clientSecret = "jyrtr64546470od";

$env = "staging"; // $env should be "staging" when in dev mode and in production change to "production"
$client = new PayWithCaptureClient($clientId, $clientSecret, $env);
$cardClient = $client->getCardPaymentClient();

$data = array(
    "amount" => 1000,
    "description" => "payment for a forLoop shirt",
    "transaction_id" => "1235GH",
    "merchant_id" => "", //You can find your merchant id on the PayWithCapture DevCenter settings page
    "cardno" => "53437464547", //account number you want to charge
    "exp_month" => "7",
    "exp_year" => "2016",
    "cvv" => "345",
    "pin" => "4556", //optional if you want to make your app more secure. Also needed for verve cards
    "bvn" => "2334567", //optional if you want to make your app more secure
    "redirect_url" => "" //url to redirect to after authentication
  );

//if you are create payment for MasterCard or Visa Card then you only
//need to create payment and display the the data['responsehtml'] in the $response
//in an iframe
$response = $cardClient->createPayment($data);

//if you created payment for Verve card then you will need to
//do validate payment process as show below
$signature = $cardClient->getPaymentRequestSignature();

//then validate with the otp and payment request signature
$resp = $cardClient->validatePayment($signature, $otp);
```

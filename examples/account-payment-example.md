# Account payment example
This is a template for you to use in your own projects for processing account payments with PayWithCapture PHP.

```PHP
use PayWithCapture\PayWithCaptureClient;

//You can find your clientId, $clientSecret in your PayWithCapture DevCenter settings page
$clientId = "745474656hdhdgftfyfjfkg";
$clientSecret = "jyrtr64546470od";

$env = "staging"; // $env should be "staging" when in dev mode and in production change to "production"
$client = new PayWithCaptureClient($clientId, $clientSecret, $env);
$accountClient = $client->getAccountPaymentClient();

$data = array(
    "amount" => 1000,
    "description" => "payment for a forLoop shirt",
    "transaction_id" => "1235GH",
    "merchant_id" => "", //You can find your merchant id on the PayWithCapture DevCenter settings page
    "account_number" => "53437464547" //account number you want to charge
  );

//once a payment is created you will get an array response.
//inspect the $accountPaymentResponse to see what a response looks like  
$accountPaymentResponse = $accountClient->createPayment($data);

//You need the create payment signature for the payment validation
//So you need to get the signature and store it for future use in validatePayment
//Note you should only call this method after calling createPayment
$signature = $accountClient->getPaymentRequestSignature();

//after a payment is created, an otp will be sent to the account holder
//ask your customer to enter their otp then validate with
//note that this validate payment is only needed for verve cards
$paymentResponse = $accountClient->validatePayment($signature, $otp);
```

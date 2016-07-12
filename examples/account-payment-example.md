# Account payment example
This is a template for you to use in your own projects for processing account payments with PayWithCapture PHP.

```
use PayWithCapture\PayWithCaptureClient;

$client = new PayWithCaptureClient($clientId, $clientSecret, $env);
$accountClient = $client->getAccountPaymentClient();
$data = array(
    "amount" => 1000,
    "description" => "payment for a forLoop shirt",
    "transaction_id" => "1235GH",
    "merchant_id" => "", //You can find your merchant id on the PayWithCapture DevCenter settings page
    "account_number" => "53437464547" //account number you want to charge
  );

//one a payment is created you will get an array response.
//inspect the $accountPaymentResponse to see what a response looks like  
$accountPaymentResponse = $accountClient->createPayment($data);

//after a payment is created, an otp will be sent to the account holder
//ask your customer to enter their otp then validate with
$paymentResponse = $accountClient->validatePayment($otp);
```

# Card payment example
This is a template for you to use in your own projects for printing details of a transation/order.

```PHP
use PayWithCapture\PayWithCaptureClient;

//You can find your clientId, $clientSecret in your PayWithCapture DevCenter settings page
$clientId = "745474656hdhdgftfyfjfkg";
$clientSecret = "jyrtr64546470od";

$env = "staging"; // $env should be "staging" when in dev mode and in production change to "production"
$client = new PayWithCaptureClient($clientId, $clientSecret, $env);
$pos = $client->getPOSPrintingClient();

//This method allows you to print transaction details with merchant code
$code = "77364"; // You can find your merchant code in your PayWithCapture DevCenter settings page
$response = $pos->printWithMerchantCode($code);

//This method allows you to print with transaction reference.
$transactionReference = "6354747494765";
$response = $pos->printWithTransactionRef($transactionReference);

```

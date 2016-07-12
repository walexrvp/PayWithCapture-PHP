# Card payment example
This is a template for you to use in your own projects for sending otp via voice calls.

```PHP
use PayWithCapture\PayWithCaptureClient;

//You can find your clientId, $clientSecret in your PayWithCapture DevCenter settings page
$clientId = "745474656hdhdgftfyfjfkg";
$clientSecret = "jyrtr64546470od";

$env = "staging"; // $env should be "staging" when in dev mode and in production change to "production"
$client = new PayWithCaptureClient($clientId, $clientSecret, $env);
$otpClient = $client->getOtpClient();

//this allows you to send otp to a user registering on your application
$phone = "+2349098090424";
$otpResponse = $otpClient->sendVoiceOtp($phone)

//this will allow you to validate the otp from the user
$authResponse = $otpClient->authenticateOtp($otp, $phone);
```

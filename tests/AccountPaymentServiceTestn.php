<?php

use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\AccountPayment;

class AccountPaymentServiceTest extends \PHPUnit_Framework_TestCase
{
  // protected $clientId = "577e5fe42989c31100b26f14";
  // protected $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  // protected $grantType = "client_credentials";
  // protected $username = "darilldrems@gmail.com";
  // protected $password = "jack2211989";
  // protected $log;
  //
  // function __construct()
  // {
  //   $this->log = Logging::getLoggerInstance();
  // }
  // private $lastUsedToken;
  //
  // public function testAccountPaymentResponseOkay()
  // {
  //   $auth = new Authentication($this->clientId, $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $accountPaymentClient = new AccountPayment($token);
  //   $paymentDetails = array(
  //     "amount" => 1000,
  //     "account_number" => "0690000032",
  //     "description" => "test by Ridwan",
  //     "transaction_id" => time(),
  //     "merchant_id" => "577e5fe42989c31100b26f13"
  //   );
  //   $response = $accountPaymentClient->createPayment($paymentDetails);
  //   $this->lastUsedToken = $accountPaymentClient->getLastPaymentAccessToken();
  //   $this->assertTrue($response['data']['verify']);
  //   $this->assertEquals("Verification Code Sent", $response['data']['message']);
  //   $this->assertNotEmpty($response['data']['order_id']);
  // }
  //
  // public function testAccountPaymentValidationResponseOkay(){
  //
  //   $accountPaymentClient = new AccountPayment($this->lastUsedToken);
  //   $otp = "12345";
  //   $response = $accountPaymentClient->validatePayment($otp);
  //   $this->log->info("AccountPaymentValidation Response: ".json_encode($response));
  // }
}

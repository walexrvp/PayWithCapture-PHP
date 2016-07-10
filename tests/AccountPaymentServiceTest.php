<?php

use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\AccountPayment;

class AccountPaymentServiceTest extends PHPUnit_Framework_TestCase
{
  private $clientId = "577e5fe42989c31100b26f14";
  private $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  private $grantType = "client_credentials";
  private $username = "darilldrems@gmail.com";
  private $password = "jack2211989";
  private $log;

  function __construct()
  {
    $this->log = Logging::getLoggerInstance();
  }

  public function testAccountPaymentResponseOkay()
  {
    $auth = new Authentication($this->clientId, $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $accountPaymentClient = new AccountPayment($token);
    $paymentDetails = array(
      "amount" => 1000,
      "account_number" => "0690000032",
      "description" => "test by Ridwan",
      "transaction_id" => time(),
      "merchant_id" => "577e5fe42989c31100b26f13"
    );
    $response = $accountPaymentClient->createPayment($paymentDetails);
    $this->assertTrue($response->verify);
    $this->assertEquals("Verification Code Sent", $response->message);
    $this->assertNotEmpty($response->orderId);
  }
}

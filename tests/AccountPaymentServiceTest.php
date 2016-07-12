<?php

use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\AccountPayment;

class AccountPaymentServiceTest extends ServiceTest
{
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

<?php

use PayWithCapture\Services\Logging;
use PayWithCapture\Services\CardPayment;
use PayWithCapture\Services\Authentication;

class CardPaymentServiceTest extends ServiceTest
{
  // public function testCardPaymentResponseOk()
  // {
  //   $auth = new Authentication($this->clientId, $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $cardPaymentClient = new CardPayment($token);
  //   $data = array(
  //     "amount" => 1000,
  //     "description" => "test card payment",
  //     "transaction_id" => time(),
  //     "merchant_id" => "577e5fe42989c31100b26f13",
  //     "card_no" => "5061020000000000094",
  //     "cvv" => "350",
  //     "exp_month" => "01",
  //     "exp_year" => "2018",
  //     "pin" => "1111"
  //   );
  //   $response = $cardPaymentClient->createPayment($data);
  //   $this->assertEquals("success", $response['status']);
  // }
}

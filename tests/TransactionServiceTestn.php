<?php

use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Transaction;

class TransactionServiceTest extends \PHPUnit_Framework_TestCase
{
  // protected $clientId = "577e5fe42989c31100b26f14";
  // protected $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  // protected $grantType = "client_credentials";
  // protected $username = "darilldrems@gmail.com";
  // protected $password = "jack2211989";
  // protected $log;
  //
  // public function testTransactionReturnedSuccessfully()
  // {
  //   $auth = new Authentication($this->clientId,
  //                               $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $transaction = new Transaction($token, "staging");
  //   $response = $transaction->findTransaction("PWCDEV-1468048254376");
  //   $this->assertFalse(empty($response['data']['order_id']));
  // }
}

<?php

use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Transaction;

class TransactionServiceTest extends ServiceTest
{
  public function testTransactionReturnedSuccessfully()
  {
    $auth = new Authentication($this->clientId,
                                $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $transaction = new Transaction($token, "staging");
    $response = $transaction->findTransaction("PWCDEV-1468048254376");
    $this->assertFalse(empty($response['data']['order_id']));
  }
}

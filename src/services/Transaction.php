<?php
namespace PayWithCapture\Services;
use PayWithCapture\Services\ServerData;

class Transaction
{
    private $accessToken;

    function __constructor($accessToken, $env = ServerData::$STAGING){
      $this->accessToken = $accessToken;
      $this->env = $env;
    }

    public function findTransaction($transactionId)
    {
      $response = RequestBuilder::getTransactionRequestBuilder($this->env)
                    ->addAccessToken($this->accessToken)
                    ->addTransactionId($this->transactionId)
                    ->build();
      return $response;
    }
}

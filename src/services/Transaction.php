<?php
namespace PayWithCapture\Services;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Logging;

class Transaction
{
    private $accessToken;
    private $env;
    private $log;

    public function __construct($accessToken, $env="staging"){
      $this->log = Logging::getLoggerInstance();
      $this->accessToken = $accessToken;
      $this->env = $env;
      $this->log->info("End of Transaction constructor");

    }

    public function findTransaction($transactionId)
    {
      $this->log->info("Transaction->findTransaction");
      $response = RequestBuilder::getTransactionRequestBuilder($this->env)
                    ->addAccessToken($this->accessToken)
                    ->addTransactionId($transactionId)
                    ->build();
      $this->log->info("Transaction object".json_encode($response));
      return $response;
    }
}

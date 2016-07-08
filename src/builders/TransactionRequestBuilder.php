<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Logging;

class TransactionRequestBuilder {

  function __construct($env)
  {
    $this->session = new \Requests_Session(ServerData::$BASE_URL[$env]);
    $this->log = Logging::getLoggerInstance();
  }

  public function addAccessToken($accessToken)
  {
    $this->session->headers['access_token'] = ServerData::$BEARER.$accessToken;
    return $this;
  }

  public function addTransactionId($transactionId)
  {
    $this->session->options['transaction_id'] = $transactionId;
    return $this;
  }

  public function build()
  {
    $response = $this->session->get(ServerData::$TRANSACTION_QUERY_PATH);
    $this->log->info("TransactionRequestBuilder build response: ".json_encode($response));
    $response = TransactionResponse::parseTransactionResponse($response);
    return $response;
  }



}

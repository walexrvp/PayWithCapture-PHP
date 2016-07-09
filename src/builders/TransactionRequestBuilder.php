<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Logging;
use PayWithCapture\Parsers\TransactionResponse;

class TransactionRequestBuilder {
  private $transactionId;

  function __construct($env)
  {
    $this->log = Logging::getLoggerInstance();
    $this->log->info("TransactionRequestBuilder base url: ".ServerData::$BASE_URL[$env]);
    $this->session = new \Requests_Session(ServerData::$BASE_URL[$env]);

  }

  private function buildQueryUrl()
  {
    $queryUrl = ServerData::$TRANSACTION_QUERY_PATH . "?transaction_id=" . $this->transactionId;
    $this->log->info("Transaction path and query: ".$queryUrl);
    return $queryUrl;
  }

  public function addAccessToken($accessToken)
  {
    $this->session->headers['Authorization'] = ServerData::$BEARER.$accessToken;
    return $this;
  }

  public function addTransactionId($transactionId)
  {
    $this->transactionId = $transactionId;
    return $this;
  }

  public function build()
  {
    $this->log->info("Transaction request headers: ".json_encode($this->session->headers));
    $this->log->info("Transaction request params: ".json_encode($this->session->options));
    $response = $this->session->get($this->buildQueryUrl());
    $this->log->info("TransactionRequestBuilder build response: ".json_encode($response));
    $response = TransactionResponse::parseTransactionResponse($response);
    return $response;
  }



}

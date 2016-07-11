<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Logging;
use PayWithCapture\Validators\ServerResponseValidator;

/*
* This class is responsible for building the request
* to the PayWithCapture server for an QR Code operations
* @extends ParentBuilder which defined the constructor as well as the
* addAccessToken method which is used to add Authentication access token
* to the request header.
* @class TransactionRequestBuilder
* @constructor
* ```
*  new TransactionRequestBuilder($env);
* ```
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class TransactionRequestBuilder extends ParentBuilder {
  private $transactionId;

  function __construct($env)
  {
    parent::__construct($env);
  }

  /*
  * private method for constructing the server url for transaction
  */
  private function buildQueryUrl()
  {
    $queryUrl = ServerData::$TRANSACTION_QUERY_PATH . "?transaction_id=" . $this->transactionId;
    $this->log->info("Transaction path and query: ".$queryUrl);
    return $queryUrl;
  }

  /*
  * @method addTransactionId
  * @param {String} transactionId.
  * @chainable
  */
  public function addTransactionId($transactionId)
  {
    $this->transactionId = $transactionId;
    return $this;
  }

  /*
  * @method build
  * this method builds the request header, data and sends request to the server.
  * validates the response with ServerResponseValidator
  * @return {array}. Json response from the server in array format.
  */
  public function build()
  {
    $this->log->info("Transaction request headers: ".json_encode($this->session->headers));
    $this->log->info("Transaction request params: ".json_encode($this->session->options));
    $response = $this->session->get($this->buildQueryUrl());
    $this->log->info("TransactionRequestBuilder build response: ".json_encode($response));
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }



}

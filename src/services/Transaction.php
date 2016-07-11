<?php
namespace PayWithCapture\Services;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Logging;

/*
* This class is responsible for using the TransactionRequestBuilder to
* make transaction request.
*/
class Transaction
{
    private $accessToken;
    private $env;
    private $log;

    /*
    * @class Transaction
    * @constructor
    * @param {String} accessToken. This token is provided by the Authentication class
    * @param {String} env. Can be staging or production.
    */
    public function __construct($accessToken, $env="staging"){
      $this->log = Logging::getLoggerInstance();
      $this->accessToken = $accessToken;
      $this->env = $env;
      $this->log->info("End of Transaction constructor");

    }

    /*
    * @class Transaction
    * @method findtransaction.
    * @param {String} accessToken. This token is provided by the Authentication class
    * @param {String} env. Can be staging or production.
    * @return {Array} transaction information.
    */
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

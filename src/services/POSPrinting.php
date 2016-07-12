<?php
namespace PayWithCapture\Services;

use PayWithCapture\Services\Logging;
use PayWithCapture\Services\RequestBuilder;

/*
* This class is responsible for prividing client interration with the
* pos printing request builder.
* @class POSPrinting
* @constructor
* ```
*  new POSPrinting($accessToken, $env);
* ```
* @param {String} $accessToken.
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class POSPrinting
{
  private $accessToken;
  private $env;
  private $log;

  function __construct($accessToken, $env = "staging")
  {
    $this->accessToken = $accessToken;
    $this->env = $env;
    $this->log = Logging::getLoggerInstance();
  }

  /*
  * This method will request for transaction details using the
  * transaction reference
  * @return {Array} json response in array format
  */
  public function printWithTransactionRef($ref)
  {
    $response = RequestBuilder::getPOSPrintingRequestBuilder($this->env)
                                  ->addAccessToken($this->accessToken)
                                  ->addReferenceNo($ref)
                                  ->build();
    return $response;
  }

  /*
  * This method will request for transaction details using the
  * transaction reference
  */
  public function printWithMerchantCode($code)
  {
    $response = RequestBuilder::getPOSPrintingRequestBuilder($this->env)
                                  ->addAccessToken($this->accessToken)
                                  ->addMerchantCode($code)
                                  ->build();
    return $response;
  }
}

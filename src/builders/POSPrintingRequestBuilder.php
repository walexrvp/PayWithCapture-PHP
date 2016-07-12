<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Validators\ServerResponseValidator;

/*
* This class is responsible for interracting with the PayWithCapture
* POSPrinting API endpoint. It builds the request params, headers, data and submits to the server
* @class POSPrintingRequestBuilder
* @extends RequestBuilder
*/
class POSPrintingRequestBuilder extends ParentBuilder
{
  private $merchantCode;
  private $referenceNo;

  function __construct($env)
  {
    parent::__construct($env);
  }

  /*
  * @method addMerchantCode
  * @param {String} code. You merchant code in the devcenter.
  * @chainable
  */
  public function addMerchantCode($code)
  {
    $this->merchantCode = "?merchant_code=".$code;
    return $this;
  }

  /*
  * @method addReferenceNo
  * @param {String} ref. Your transaction reference number.
  * @chainable
  */
  public function addReferenceNo($ref)
  {
    $this->referenceNo = "?reference_no=".$ref;
    return $this;
  }

  /*
  * @method build
  * sends request to the PayWithCapture Server, validates response with
  * ServerResponseValidator, if valid returns response body in array format
  */
  public function build()
  {
    $this->log->info("In POSPrintingRequestBuilder");
    $response = $this->session->get(ServerData::$TRANSACTION_QUERY_PATH . $this->referenceNo . $this->merchantCode);
    $this->log->info("POSPrintingRequestBuilder response: " . json_encode($response));
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }
}

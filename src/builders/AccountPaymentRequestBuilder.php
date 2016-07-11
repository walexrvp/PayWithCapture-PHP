<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Validators\ServerResponseValidator;

/*
* This class is responsible for building the request
* to the PayWithCapture server for any AccountPayment operation
* @extends ParentBuilder which defined the constructor as well as the
* addAccessToken method which is used to add Authentication access token
* to the request header.
* @class AccountPaymentRequestBuilder
* ```
*  new AccountPaymentRequestBuilder($env);
* ```
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class AccountPaymentRequestBuilder extends ParentBuilder
{
  function __construct($env)
  {
    parent::__construct($env);
  }

  /*
  * adds type to the data to send with the request to the server
  * @method addType
  * @param {String} type. transaction type. can be card or account
  * @chainable
  */
  public function addType($type)
  {
    $this->session->data['type'] = $type;
    return $this;
  }

  /*
  * adds amount to the data to send with the request to the server
  * @method addAmount
  * @param {Number} type. Transaction amount
  * @chainable
  */
  public function addAmount($amount)
  {
    $this->session->data['amount'] = $amount;
    return $this;
  }

  /*
  * adds description to the data to send with the request to the server
  * @method addDescription
  * @param {String} description.
  * @chainable
  */
  public function addDescription($description)
  {
    $this->session->data['description'] = $description;
    return $this;
  }

  /*
  * adds transaction id to the data to send with the request to the server
  * @method addTransactionId
  * @param {String} transactionId.
  * @chainable
  */
  public function addTransactionId($transactionId)
  {
    $this->session->data['transaction_id'] = $transactionId;
    return $this;
  }

  /*
  * adds merchant id to the data to send with the request to the server
  * @method addMerchantId
  * @param {String} merchantId. Your merchant id in the devcenter
  * @chainable
  */
  public function addMerchantId($merchantId)
  {
    $this->session->data['merchant_id'] = $merchantId;
    return $this;
  }

  /*
  * adds account number to the data to send with the request to the server
  * @method addAccountNumber
  * @param {String} accountNumber. account number to be used for the transaction
  * @chainable
  */
  public function addAccountNumber($accountNumber)
  {
    $this->session->data['accountnumber'] = $accountNumber;
    return $this;
  }

  /*
  * This method builds the request and sends the request to the server
  * once the server responds, it validates the response with ServerResponseValidator
  * if valid then returns the response->body in array format to the client.
  * @return AccountPayment
  */
  public function build()
  {
    $this->log->info("AccountPayment headers: ".json_encode($this->session->headers));
    $this->log->info("Account payment data: ".json_encode($this->session->data));
    $response = $this->session->post(ServerData::$PAYMENT_PATH);
    $this->log->info("AccountPaymentBuilder build response: ".json_encode($response));
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }
}

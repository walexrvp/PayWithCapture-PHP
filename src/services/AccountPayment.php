<?php
namespace PayWithCapture\Services;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Contracts\PaymentContract;

/*
* This class is responsible for prividing client interration with the
* account payment request builder.
* It implements the Payment contract as a promise on which features to
* provide.
* @class AccountPayment
* @constructor
* ```
*  new AccountPayment($accessToken, $env);
* ```
* @param {String} $accessToken.
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class AccountPayment implements PaymentContract{
  private $accessToken;
  private $env;

  /*
  * @class AccountPayment
  * @constructor
  *
  */
  function __construct($accessToken, $env = "staging")
  {
    $this->accessToken = $accessToken;
    $this->env = $env;
  }

  /*
  * This method initiates a payment. remember a created payment needs to be validated
  * for the transaction to be successful.
  * @method createPayment
  * @param {Number} params['amount']
  * @param {String} params['description']
  * @param {String} params['transaction_id']
  * @param {String} params['merchant_id']
  * @param {String} params['acccount_number']
  * @returns {Array} json response from server in array format
  */
  public function createPayment(array $params)
  {
    $accountPayment = RequestBuilder::getAccountPaymentRequestBuilder($this->env)
                        ->addAccessToken($this->accessToken)
                        ->addType(ServerData::$ACCOUNT_PAYMENT_TYPE)
                        ->addAmount($params['amount'])
                        ->addDescription($params['description'])
                        ->addTransactionId($params['transaction_id'])
                        ->addMerchantId($params['merchant_id'])
                        ->addAccountNumber($params['account_number'])
                        ->build();
    return $accountPayment;
  }

  /*
  * This method validates an initiated payment using otp sent to the user.
  * @method validatePayment
  * @param {String} otp.
  * @returns {Array} json response from server in array format
  */
  public function validatePayment($otp)
  {
    $response = RequestBuilder::getPaymentValidationRequestBuilder($this->env)
                                  ->addAccessToken($this->accessToken)
                                  ->addType(ServerData::$ACCOUNT_PAYMENT)
                                  ->addOtp($otp)
                                  ->build();
    return $response;
  }

}

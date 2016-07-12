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
  private $signature;

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
    $response = RequestBuilder::getAccountPaymentRequestBuilder($this->env)
                        ->addAccessToken($this->accessToken)
                        ->addType(ServerData::$ACCOUNT_PAYMENT_TYPE)
                        ->addAmount($params['amount'])
                        ->addDescription($params['description'])
                        ->addTransactionId($params['transaction_id'])
                        ->addMerchantId($params['merchant_id'])
                        ->addAccountNumber($params['account_number'])
                        ->build();
    $this->setPaymentRequestSignature($this->accessToken, $response->cookies);
    return json_decode($response->body, true);
  }

  /*
  * This method is needed to ensure the createpayment request
  * and validate payment request are identical with accessToken and
  * and the cookies set are the same for server side validation.
  * after create payment call getPaymentRequestSignature and store
  * the signature to use later for validate payment.
  * remember validate payment is only needed for Verve cards
  */
  private function setPaymentRequestSignature($token, $cookies)
  {
    $this->signature['accessToken'] = $token;
    $this->signature['cookies'] = $cookies;
  }

  /*
  * get signature
  */
  public function getPaymentRequestSignature()
  {
    return $this->signature;
  }


  /*
  * @method getLastPaymentAccessToken
  * This will return the last used accessToken for payment.
  * this method is needed so the client can store the access token to be used to validate
  * a payment later
  */
  public function getLastPaymentAccessToken()
  {
    return $this->accessToken;
  }


  /*
  * This method validates an initiated payment using otp sent to the user.
  * @method validatePayment
  * @param {String} otp.
  * @returns {Array} json response from server in array format
  */
  public function validatePayment($signature, $otp)
  {
    print($otp);
    $response = RequestBuilder::getPaymentValidationRequestBuilder($this->env)
                                  ->addCookies($signature['cookies'])
                                  ->addAccessToken($signature['accessToken'])
                                  ->addType(ServerData::$ACCOUNT_PAYMENT)
                                  ->addOtp($otp)
                                  ->build();
    return $response;
  }

}

<?php
namespace PayWithCapture\Services;

use PayWithCapture\Builders\CardPaymentRequestBuilder;
use PayWithCapture\Contracts\PaymentContract;
use PayWithCapture\Services\Logging;

/*
* This class is responsible for using the CardRequestBuilder to
* make card payments request.
* @implements PaymentContract as a contract
*/
class CardPayment implements PaymentContract
{
  private $accessToken;
  private $env;
  private $signature;

  /*
  * @class CardPayment
  * @constructor
  * ```
  * new CardPayment($accessToken, $env);
  * ```
  */
  function __construct($accessToken, $env = "staging")
  {
    $this->accessToken = $accessToken;
    $this->env = $env;

    $this->log = Logging::getLoggerInstance();
  }

  /*
  * This method initiates a payment. remember a created payment needs to be validated
  * for the transaction to be successful.
  * @method createPayment
  * @param {Number} data['amount']
  * @param {String} data['description']
  * @param {String} data['transaction_id']
  * @param {String} data['merchant_id']
  * @param {String} data['card_no']
  * @param {String} data['exp_month']
  * @param {String} data['exp_year']
  * @param {String} data[bvn] optional
  * @param {String} data[pin] optional
  * @param {String} data[redirect_url] optional
  * @returns {Array} json response from server in array format
  */
  public function createPayment(array $data)
  {
    $pin = isset($data['pin']) ? $data['pin'] : "";
    $bvn = isset($data['bvn']) ? $data['bvn'] : "";
    $redirect_url = isset($data['redirect_url']) ? $data['redirect_url'] : "";
    $response = RequestBuilder::getCardPaymentRequestBuilder($this->env)
                                  ->addType(ServerData::$CARD_PAYMENT_TYPE)
                                  ->addAccessToken($this->accessToken)
                                  ->addAmount($data['amount'])
                                  ->addDescription($data['description'])
                                  ->addCvv($data['cvv'])
                                  ->addTransactionId($data['transaction_id'])
                                  ->addMerchantId($data['merchant_id'])
                                  ->addPin($pin)
                                  ->addBvn($bvn)
                                  ->addCardNo($data['card_no'])
                                  ->addExpMnth($data['exp_month'])
                                  ->addExpYear($data['exp_year'])
                                  ->addRedirectUrl($redirect_url)
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
    $response = RequestBuilder::getPaymentValidationRequestBuilder($this->env)
                                  ->addCookies($signature['cookies'])
                                  ->addAccessToken($signature['accessToken'])
                                  ->addType(ServerData::$CARD_PAYMENT)
                                  ->addOtp($otp)
                                  ->build();
    return $response;
  }

}

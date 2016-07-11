<?php
namespace PayWithCapture\Services;

use PayWithCapture\Builders\CardPaymentRequestBuilder;
use PayWithCapture\Contracts\PaymentContract;

/*
* This class is responsible for using the CardRequestBuilder to
* make card payments request.
* @implements PaymentContract as a contract
*/
class CardPayment implements PaymentContract
{
  private $accessToken;
  private $env;

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
    return $response;
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

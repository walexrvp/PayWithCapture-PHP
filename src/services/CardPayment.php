<?php
namespace PayWithCapture\Services;

use PayWithCapture\Builders\CardPaymentRequestBuilder;
use PayWithCapture\Contracts\PaymentContract;

class CardPayment implements PaymentContract
{
  private $accessToken;
  private $env;

  function __construct($accessToken, $env = "staging")
  {
    $this->accessToken = $accessToken;
    $this->env = $env;
  }

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

<?php
namespace PayWithCapture\Services;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Contracts\PaymentContract;

class AccountPayment implements PaymentContract{
  private $accessToken;
  private $env;

  function __construct($accessToken, $env = "staging")
  {
    $this->accessToken = $accessToken;
    $this->env = $env;
  }

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

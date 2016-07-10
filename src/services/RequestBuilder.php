<?php
/*
* This class is responsible for building requests
* to PayWithCapture Server
*/
namespace PayWithCapture\Services;

use PayWithCapture\Builders\AuthenticationRequestBuilder;
use PayWithCapture\Builders\TransactionRequestBuilder;
use PayWithCapture\Builders\AccountPaymentRequestBuilder;
use PayWithCapture\Builders\PaymentValidationRequestBuilder;
use PayWithCapture\Builders\CardPaymentRequestBuilder;
use PayWithCapture\Builders\OtpRequestBuilder;

class RequestBuilder
{

  public static function getAuthenticationRequestBuilder($env)
  {
    return new AuthenticationRequestBuilder($env);
  }

  public static function getTransactionRequestBuilder($env)
  {
    return new TransactionRequestBuilder($env);
  }

  public static function getAccountPaymentRequestBuilder($env)
  {
    return new AccountPaymentRequestBuilder($env);
  }

  public static function getPaymentValidationRequestBuilder($env)
  {
    return new PaymentValidationRequestBuilder($env);
  }

  public static function getCardPaymentRequestBuilder($env)
  {
    return new CardPaymentRequestBuilder($env);
  }

  public static function getOtpRequestBuilder($env)
  {
    return new OtpRequestBuilder($env);
  }


}

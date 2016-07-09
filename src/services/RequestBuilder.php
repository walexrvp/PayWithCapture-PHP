<?php
/*
* This class is responsible for building requests
* to PayWithCapture Server
*/
namespace PayWithCapture\Services;

use PayWithCapture\Builders\AuthenticationRequestBuilder;
use PayWithCapture\Builders\TransactionRequestBuilder;
use PayWithCapture\Builders\AccountPaymentRequestBuilder;

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


}

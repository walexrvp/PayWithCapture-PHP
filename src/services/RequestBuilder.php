<?php
/*
* This class is responsible for building requests
* to PayWithCapture Server
*/
namespace PayWithCapture\Services;

use PayWithCapture\Builders\AuthenticationRequestBuilder;

class RequestBuilder
{

  public static function getAuthenticationRequestBuilder($env)
  {
    return new AuthenticationRequestBuilder($env);
  }

  public static function getTransactionRequestBuilder()
  {

  }


}

<?php
namespace PayWithCapture;

use PayWithCapture\Interfaces\APIServices;
use PayWithCapture\Services\Transaction;

class PayWithCaptureClient implements APIServices
{
  public const STAGING = "staging";
  public const PRODUCTION = "production";

  private $env;

  private $authentication;

  function __construct($clientId, $clientSecret, $env=self::STAGING, $eagerLoading=false, $username="", $password="")
  {
    $this->env = $env;
    $authentication = new Authentication($clientId, $clientSecret, $env, $eagerLoading, $username, $password);
  }

  public function getTransactionClient()
  {
      $authentication->loadAccessToken();
      $accessToken = $authentication->getAccessToken();
      return new Transaction($accessToken, $this->env);
  }
}

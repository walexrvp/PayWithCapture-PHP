<?php
namespace PayWithCapture;

use PayWithCapture\Interfaces\APIServices;
use PayWithCapture\Services\Transaction;
use PayWithCapture\Services\ServerData;

class PayWithCaptureClient implements APIServices
{
  private $env;

  private $authentication;

  function __construct($clientId, $clientSecret, $env = ServerData::$STAGING, $eagerLoading = false, $username = "", $password = "")
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

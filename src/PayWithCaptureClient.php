<?php
namespace PayWithCapture;

use PayWithCapture\Contracts\APIContract;
use PayWithCapture\Services\Transaction;
use PayWithCapture\Services\ServerData;

/*
* This class is responsible for getting clients to
* all services provided by PayWithCapture
* $client = new PayWithCaptureClient($clientId, $clientSecret, $environment)
* the $environment variable can either be "staging" or "production"
* depending on the stage of development you are in.
*/
class PayWithCaptureClient implements APIContract
{
  private $env;

  private $authentication;

  function __construct($clientId, $clientSecret, $env = ServerData::$STAGING, $eagerLoading = false, $username = "", $password = "")
  {
    $this->env = $env;
    $authentication = new Authentication($clientId, $clientSecret, $env, $eagerLoading, $username, $password);
  }

  /*
  * This method returns a Transaction client for interacting
  * with transaction endpoints such as get details of a transaction
  * transactionClient = $client->getTransactionClient();
  * transactionClient->findTransaction($transactionId);
  * @return TransactionResponse
  * @throws Exceptions
  */
  public function getTransactionClient()
  {
      $authentication->loadAccessToken();
      $accessToken = $authentication->getAccessToken();
      return new Transaction($accessToken, $this->env);
  }

  public function getAccountPaymentClient()
  {

  }
}

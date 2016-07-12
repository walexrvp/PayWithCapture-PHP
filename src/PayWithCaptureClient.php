<?php
namespace PayWithCapture;

use PayWithCapture\Contracts\APIContract;
use PayWithCapture\Services\Transaction;
use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Otp;
use PayWithCapture\Services\CardPayment;
use PayWithCapture\Services\AccountPayment;
use PayWithCapture\Services\QRCode;
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\POSPrinting;

/*
* This is the entry point of this library
*
* $client = new PayWithCaptureClient($clientId, $clientSecret, $environment)
* the $environment variable can either be "staging" or "production"
* depending on the stage of development you are in.
*/
class PayWithCaptureClient implements APIContract
{
  private $env;

  private $authentication;

  function __construct($clientId, $clientSecret, $env = "staging", $eagerLoading = false, $username = "", $password = "")
  {
    $this->env = $env;
    $this->authentication = new Authentication($clientId, $clientSecret, $env, $eagerLoading, $username, $password);
  }

  private function loadAuthAndReturnAccessToken()
  {
    $this->authentication->loadAccessToken();
    return $this->authentication->getAccessToken();
  }

  /*
  * This method returns a Transaction client for interacting
  * with transaction endpoints such as get details of a transaction
  * transactionClient = $client->getTransactionClient();
  * transactionClient->findTransaction($transactionId);
  * @return {Array} json response string from server in array format.
  * @throws Exceptions
  */
  public function getTransactionClient()
  {
    return new Transaction($this->loadAuthAndReturnAccessToken(), $this->env);
  }

  /*
  * returns account payment client
  */
  public function getAccountPaymentClient()
  {
    return new AccountPayment($this->loadAuthAndReturnAccessToken(), $this->env);
  }

  /*
  * returns card payment client
  */
  public function getCardPaymentClient()
  {
    return new CardPayment($this->loadAuthAndReturnAccessToken(), $this->env);
  }

  /*
  * returns otp client
  */
  public function getOtpClient()
  {
    return new Otp($this->loadAuthAndReturnAccessToken(), $this->env);
  }

  /*
  * returns qr code client
  */
  public function getQRCodeClient()
  {
    return new QRCode($this->loadAuthAndReturnAccessToken(), $this->env);
  }

  /*
  * returns pos printing client
  */
  public function getPOSPrintingClient()
  {
    return new POSPrinting($this->loadAuthAndReturnAccessToken(), $this->env);
  }
}

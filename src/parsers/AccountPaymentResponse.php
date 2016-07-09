<?php
namespace PayWithCapture\Parsers;

use PayWithCapture\Services\Logging;

class AccountPaymentResponse
{
  public $orderId;
  public $verify;
  public $message;

  /*
  * This method is responsible for parsing json string from Server
  * and setting class attributes
  */
  public static function parseServerResponse($response)
  {
    $log = Logging::getLoggerInstance();
    $log->info("Account Payment Server Response: ".$response->body);

    if ($response->status_code == 404)
      throw new Exception(""); //TODO: throw not found exception

    if ($response->status_code == 401)
      throw new Exception(""); //TODO: unauthorized access exception

    if ($response->status_code == 403)
      throw new Exception(""); //TODO: unauthorized access Exception


    $responseInArrayFormat = json_decode($response->body, true);

    if ($responseInArrayFormat['status'] == "error")
      throw new Exception(""); //TODO: throw invalid request exception and display message

    $payment = new AccountPaymentResponse();
    $payment->orderId = $responseInArrayFormat['data']['order_id'];
    $payment->verify = $responseInArrayFormat['data']['verify'];
    $payment->message = $responseInArrayFormat['data']['message'];

    return $payment;
  }
}

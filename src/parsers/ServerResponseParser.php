<?php
namespace PayWithCapture\Parsers;

use PayWithCapture\Services\Logging;
use PayWithCapture\Responses\AccountPayment;
use PayWithCapture\Responses\Transaction;
use PayWithCapture\Responses\Authentication;

class ServerResponseParser
{
  private static $log;

  private static function init()
  {
    self::$log = Logging::getLoggerInstance();
  }

  /*
  * This function is responsible for validating Htt response
  * from the server. If any errors, it throws exceptions for the errors.
  * @param RequestResponse
  * @return void
  */
  private static function validateServerResponse($response)
  {
    self::init();
    self::$log->info("Account Payment Server Response: ".$response->body);

    if ($response->status_code == 404)
      throw new Exception(""); //TODO: throw not found exception

    if ($response->status_code == 401)
      throw new Exception(""); //TODO: unauthorized access exception

    if ($response->status_code == 403)
      throw new Exception(""); //TODO: unauthorized access Exception

    $responseInArrayFormat = json_decode($response->body, true);

    if ($responseInArrayFormat['status'] == "error")
      throw new Exception(""); //TODO: throw invalid request exception and display message
  }

  public static function parseAuthenticationResponse($response)
  {
    self::validateServerResponse($response);
    $responseInArrayFormat = json_decode($response->body, true);
    $auth = new Authentication();
    $auth->accessToken = $responseInArrayFormat['access_token'];
    $auth->expiresIn = $responseInArrayFormat['expires_in'];
    $auth->refreshToken = $responseInArrayFormat['refresh_token'];
    $auth->tokenType = $responseInArrayFormat['refresh_type'];
    return $auth;
  }

  /*
  * This method is responsible for parsing json string from Server
  * for requests to Account Payment endpoint
  * and setting class attributes
  */
  public static function parseAccountPaymentResponse($response)
  {
    self::validateServerResponse($response);
    $responseInArrayFormat = json_decode($response->body, true);
    $payment = new AccountPayment();
    $payment->orderId = $responseInArrayFormat['data']['order_id'];
    $payment->verify = $responseInArrayFormat['data']['verify'];
    $payment->message = $responseInArrayFormat['data']['message'];
    return $payment;
  }

  /*
  * This method is responsible for parsing json string from Server
  * for requests to Transaction endpoint
  * and setting class attributes
  */
  public static function parseTransactionResponse($response)
  {
    self::validateServerResponse($response);
    $responseInArrayFormat = json_decode($response->body, true);
    $newTrans = new Transaction();
    $newTrans->orderId = $responseInArrayFormat['data']['order_id'];
    $newTrans->responseMessage = $responseInArrayFormat['data']['gateway_response']['responsemessage'];
    $newTrans->responseToken = $responseInArrayFormat['data']['gateway_response']['responsetoken'];
    $newTrans->responseCode = $responseInArrayFormat['data']['gateway_response']['responsecode'];
    $newTrans->transactionReference = $responseInArrayFormat['data']['gateway_response']['transactionreference'];
    $newTrans->otpTransactionIdentifier = $responseInArrayFormat['data']['gateway_response']['otptransactionidentifier'];
    $newTrans->responseHtml = $responseInArrayFormat['data']['gateway_response']['responsehtml'];
    $newTrans->paymentId = $responseInArrayFormat['data']['payment_id'];
    $newTrans->amount = $responseInArrayFormat['data']['amount'];
    $newTrans->paymentRef = $responseInArrayFormat['data']['payment_ref'];
    $newTrans->transactionId = $responseInArrayFormat['data']['transaction_id'];
    $newTrans->customerNarration = $responseInArrayFormat['data']['customerNarration'];
    $newTrans->customerRef = $responseInArrayFormat['data']['customer_ref'];
    $newTrans->status = $responseInArrayFormat['data']['status'];
    $newTrans->description = $responseInArrayFormat['data']['description'];
    $newTrans->linkingRef = $responseInArrayFormat['data']['linking_ref'];
    $newTrans->reconRef = $responseInArrayFormat['data']['recon_ref'];
    $newTrans->merchantFee = $responseInArrayFormat['data']['merchant_fee'];
    $newTrans->cardLocale = $responseInArrayFormat['data']['card_locale'];
    return $newTrans;
  }

}

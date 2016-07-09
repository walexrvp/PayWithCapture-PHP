<?php
namespace PayWithCapture\Parsers;

use PayWithCapture\Services\Logging;

class TransactionResponse
{
  public $responseMessage;
  public $responseToken;
  public $responseCode;
  public $responseHtml;
  public $orderId;
  public $transactionReference;
  public $paymentId;
  public $amount;
  public $paymentRef;
  public $transactionId;
  public $customerNarration;
  public $customerRef;
  public $status;
  public $description;
  public $linkingRef;
  public $reconRef;
  public $merchantFee;
  public $cardLocale;
  public $paymentDate;
  public $otpTransactionIdentifier;


  public static function parseTransactionResponse($response)
  {
    $log = Logging::getLoggerInstance();

    if ($response->status_code == 401)
      throw new Exception(); //TODO custom 401 exception;

    if ($response->status_code == 403)
      throw new Exception(); //TODO custom 403 exception

    $responseInArrayFormat = json_decode($response->body, true);
    $log->info("responseInArrayFormat".json_encode($responseInArrayFormat['data']));

    if ($responseInArrayFormat['status'] == "error")
      throw new Exception(); //TODO: Error in request

    $newTrans = new TransactionResponse();
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

<?php
namespace PayWithCapture\Parsers;

class TransactionResponse
{
  private $transactionReference;
  private $responseMessage;
  private $responseToken;

  public function getTransactionReference()
  {
    return $this->transactionReference;
  }

  public function setTransactionReference($ref)
  {
    $this->transactionReference = $ref;
  }

  public function getResponseMessage()
  {
    return $this->responseMessage;
  }

  public function setResponseMessage($msg)
  {
    $this->responseMessage = $msg;
  }

  public function getResponseToken()
  {
    return $this->responseToken;
  }

  public function setResponseToken($token)
  {
    $this->responseToken = $token;
  }


  public static function parseTransactionResponse($response)
  {
    $responeInArrayFormat = json_decode($response, true);
    $newTransactionResponse = new TransationResponse();
    $newTransactionResponse->setTransactionReference($responseInArrayFormat['data']['responsereference']);
    $newTransactionResponse->setResponseMessage($responseInArrayFormat['data']['responsemessage']);
    $newTransactionResponse->setResponseToken($responseInArrayFormat['data']['responsetoken']);
    return $newTransactionResponse;
  }
}

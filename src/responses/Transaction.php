<?php
namespace PayWithCapture\Responses;

class Transaction
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
}

<?php
namespace PayWithCapture\Responses;
use PayWithCapture\Services\AccountPayment;

class AccountPayment
{
  public $orderId;
  public $verify;
  public $message;
}

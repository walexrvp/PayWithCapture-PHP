<?php
namespace PayWithCapture\Contracts;

interface APIContract
{
  public function getTransactionClient();
  public function getAccountPaymentClient();
  public function getOTPClient();
  public function getBVNClient();
  public function getQRCodeClient();
}

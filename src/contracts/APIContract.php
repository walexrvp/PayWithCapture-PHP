<?php
namespace PayWithCapture\Contracts;
/*
* This represents the contract btw us and developers
* to indicated the services we hope to support irregardless
* of internal implementation which is subjected to change.
*/
interface APIContract
{
  public function getTransactionClient();
  public function getAccountPaymentClient();
  public function getOTPClient();
  public function getBVNClient();
  public function getQRCodeClient();
}

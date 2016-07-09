<?php
/*
* This interface is responsible for defining
* the contract that must be implemented by any Payment
* class either AccountPayment or CardPayment
*/
namespace PayWithCapture\Contracts;

interface PaymentContract
{
  public function createPayment(array $params);
  public function validatePayment($otp);
}

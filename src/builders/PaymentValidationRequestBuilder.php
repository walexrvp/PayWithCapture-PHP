<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Validators\ServerResponseValidator;

class PaymentValidationRequestBuilder extends ParentBuilder
{
  public function addType($type)
  {
    $this->session->data['type'] = $type;
    return $this;
  }

  public function addOtp($otp)
  {
    $this->session->data['otp'] = $type;
    return $this;
  }

  public function build()
  {
    $this->log->info("Transaction request headers: ".json_encode($this->session->headers));
    $this->log->info("Transaction request params: ".json_encode($this->session->options));
    $response = $this->session->post(ServerData::$PAYMENT_VALIDATION_URL);
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }
}

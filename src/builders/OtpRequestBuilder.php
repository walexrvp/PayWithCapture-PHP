<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Validators\ServerResponseValidator;

class OtpRequestBuilder extends ParentBuilder
{
  private $phone;
  private $otpType;

  function __construct($env)
  {
    parent::__construct($env);
  }

  private function buildQueryUrl(){
    if ($this->otpType == ServerData::$SMS_OTP_TYPE)
      return ServerData::$OTP_PATH . "/" . ServerData::$SMS_OTP_TYPE . "/" . $this->phone;
    return ServerData::$OTP_PATH . "/" . ServerData::$VOICE_OTP_TYPE . "/" . $this->phone;
  }

  public function addPhone($phone)
  {
    $this->phone = $phone;
    return $this;
  }

  public function addType($type)
  {
    $this->otpType = $type;
    return $this;
  }

  public function addPhoneAuth($phone)
  {
    $this->session->data['phonenumber'] = $phone;
    return $this;
  }

  public function addOtpAuth($otp)
  {
    $this->session->data['otp'] = $otp;
    return $this;
  }

  public function buidOtpAuth(){
    $this->log->info("Otp authentication headers: " . json_encode($this->session->headers));
    $this->log->info("Otp authentication data: " . json_encode($this->session->data));
    $response = $this->session->post(ServerData::$OTP_AUTH_PATH);
    $this->log->info("Otp Authentication RequestBuilder build response: ".json_encode($response));
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }

  public function build()
  {
    $this->log->info("Otp request headers: ".json_encode($this->session->headers));
    $this->log->info("Otp request params: ".json_encode($this->session->options));
    $url = $this->buildQueryUrl();
    $this->log->info("Otp request path: ".$url);
    $response = $this->session->get($url);
    $this->log->info("Otp RequestBuilder build response: ".json_encode($response));
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }

}

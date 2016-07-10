<?php
namespace PayWithCapture\Services;

use PayWithCapture\Services\ServerData;

class Otp
{
  private $accessToken;
  private $env;

  function __construct($accessToken, $env = "staging")
  {
    $this->accessToken = $accessToken;
    $this->env = $env;
  }

  private function sendOtp($type, $phone)
  {
    $response =  RequestBuilder::getOtpRequestBuilder($this->env)
                                  ->addPhone($phone)
                                  ->addType($type)
                                  ->addAccessToken($this->accessToken)
                                  ->build();
    return $response;
  }

  public function sendSmsOtp($phone)
  {
    return $this->sendOtp(ServerData::$SMS_OTP_TYPE, $phone);
  }

  public function sendVoiceOtp($phone)
  {
    return $this->sendOtp(ServerData::$VOICE_OTP_TYPE, $phone);
  }
}

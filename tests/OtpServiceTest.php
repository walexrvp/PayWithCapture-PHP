<?php
use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\Otp;

class OtpServiceTest extends ServiceTest
{
  function testSmsOtpResponseOk()
  {
    $auth = new Authentication($this->clientId, $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $otpClient = new Otp($token);
    $smsResponse = $otpClient->sendSmsOtp("2349098090424");
    $this->assertEquals("success", $smsResponse['status']);
  }

  function testVoiceOtpResponseOk()
  {
    $auth = new Authentication($this->clientId, $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $otpClient = new Otp($token);
    $voiceResponse = $otpClient->sendVoiceOtp("2349098090424");
    $this->assertEquals("success", $voiceResponse['status']);
  }

  function testOtpAuthResponseOk()
  {
    $auth = new Authentication($this->clientId, $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $otpClient = new Otp($token);
    $smsResponse = $otpClient->authenticateOtp("12345", "2349098090424");
    $this->assertEquals("success", $smsResponse['status']);
  }
}

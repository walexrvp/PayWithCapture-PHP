<?php
use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\Otp;

class OtpServiceTest extends PHPUnit_Framework_TestCase
{
  private $clientId = "577e5fe42989c31100b26f14";
  private $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  private $grantType = "client_credentials";
  private $username = "darilldrems@gmail.com";
  private $password = "jack2211989";
  private $log;

  function __construct()
  {
    $this->log = Logging::getLoggerInstance();
  }

  function testOtpResponseOk()
  {
    $auth = new Authentication($this->clientId, $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $otpClient = new Otp($token);
    $smsResponse = $otpClient->sendSmsOtp("2349098090424");
    $voiceResponse = $otpClient->sendVoiceOtp("2349098090424");
    $this->assertEquals("success", $smsResponse['status']);
    $this->assertEquals("success", $voiceResponse['status']);
  }
}

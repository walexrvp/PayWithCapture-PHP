<?php
use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\Otp;

class OtpServiceTest extends \PHPUnit_Framework_TestCase
{
  // protected $clientId = "577e5fe42989c31100b26f14";
  // protected $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  // protected $grantType = "client_credentials";
  // protected $username = "darilldrems@gmail.com";
  // protected $password = "jack2211989";
  // protected $log;
  // 
  // function __construct()
  // {
  //   $this->log = Logging::getLoggerInstance();
  // }
  //
  // function testSmsOtpResponseOk()
  // {
  //   $auth = new Authentication($this->clientId, $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $otpClient = new Otp($token);
  //   $smsResponse = $otpClient->sendSmsOtp("2349098090424");
  //   $this->assertEquals("success", $smsResponse['status']);
  // }
  //
  // function testVoiceOtpResponseOk()
  // {
  //   $auth = new Authentication($this->clientId, $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $otpClient = new Otp($token);
  //   $voiceResponse = $otpClient->sendVoiceOtp("2349098090424");
  //   $this->assertEquals("success", $voiceResponse['status']);
  // }
  //
  // function testOtpAuthResponseOk()
  // {
  //   $auth = new Authentication($this->clientId, $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $otpClient = new Otp($token);
  //   $smsResponse = $otpClient->authenticateOtp("12345", "2349098090424");
  //   $this->assertEquals("success", $smsResponse['status']);
  // }
}

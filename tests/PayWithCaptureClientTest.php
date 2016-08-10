<?php
namespace Tests;

use PayWithCapture\PayWithCaptureClient;
use PayWithCapture\Services\Logging;

class PayWithCaptureClientTest extends \PHPUnit_Framework_TestCase
{
  protected $clientId = "577e5fe42989c31100b26f14";
  protected $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  protected $grantType = "client_credentials";
  protected $username = "darilldrems@gmail.com";
  protected $password = "jack2211989";
  protected $log;

  function __construct()
  {
    $this->log = Logging::getLoggerInstance();
  }

  public function testPOSPrintingWithTransactionRefClientOk()
  {
    $client = new PayWithCaptureClient($this->clientId, $this->clientSecret);
    $pos = $client->getPOSPrintingClient();
    $ref = "08442947254";
    $response = $pos->printWithTransactionRef($ref);
    $this->assertEquals("success", $response['status']);
  }

  public function testPOSPrintingWithMerchantCodeClientOk()
  {
    $client = new PayWithCaptureClient($this->clientId, $this->clientSecret);
    $pos = $client->getPOSPrintingClient();
    $code = "6836006";
    $response = $pos->printWithMerchantCode($code);
    $this->assertEquals("success", $response['status']);
  }

  public function testSMSOtpClientOk()
  {
    $pwcClient = new PayWithCaptureClient($this->clientId, $this->clientSecret);
    $otpClient = $pwcClient->getOtpClient();
    $response = $otpClient->sendSmsOtp("+2349098090424");
    $this->assertEquals("success", $response['status']);
  }

  public function testVoiceOtpClientOk()
  {
    $pwcClient = new PayWithCaptureClient($this->clientId, $this->clientSecret);
    $otpClient = $pwcClient->getOtpClient();
    $response = $otpClient->sendVoiceOtp("+2349098090424");
    $this->assertEquals("success", $response['status']);
  }

}

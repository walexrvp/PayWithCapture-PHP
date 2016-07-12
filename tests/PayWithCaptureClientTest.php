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

  public function testAccountPaymentClientSuccessful()
  {
    $client = new PayWithCaptureClient($this->clientId, $this->clientSecret);
    $accPaymentClient = $client->getAccountPaymentClient();
    $paymentDetails = array(
      "amount" => 1000,
      "account_number" => "0690000032",
      "description" => "test by Ridwan",
      "transaction_id" => time(),
      "merchant_id" => "577e5fe42989c31100b26f13"
    );
    $response = $accPaymentClient->createPayment($paymentDetails);
    $this->log->info("created payment response: ". json_encode($response));
    $this->assertEquals("success", $response['status']);
    $signature = $accPaymentClient->getPaymentRequestSignature();
    $otp = "12345";
    $vResponse = $accPaymentClient->validatePayment($signature, $otp);
    $this->log->info("created payment validation response: ". json_encode($vResponse));
    $this->assertEquals("success", $vResponse['status']);
  }

  public function testCardPaymentClientSuccessful()
  {
    $client = new PayWithCaptureClient($this->clientId, $this->clientSecret);
    $cardClient = $client->getCardPaymentClient();
    $paymentDetails = array(
        "amount" => 1000,
        "description" => "test by Ridwan",
        "transaction_id" => time(),
        "merchant_id" => "577e5fe42989c31100b26f13",
        "card_no" => "5061020000000000094",
        "exp_month" => "01",
        "exp_year" => "2018",
        "cvv" => "350",
        "pin" => "1111"
    );
    $paymentResponse = $cardClient->createPayment($paymentDetails);
    $this->log->info("created card payment response: ". json_encode($paymentResponse));
    $signature = $cardClient->getPaymentRequestSignature();
    $otp = "12345";
    $confirmationResponse = $cardClient->validatePayment($signature, $otp);
    $this->log->info("created card payment validation response: ". json_encode($confirmationResponse));
    $this->assertEquals("success", $confirmationResponse['status']);
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

<?php
namespace Tests;

use PayWithCapture\PayWithCaptureClient;

class PayWithCaptureClientTest extends ServiceTest
{
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
}

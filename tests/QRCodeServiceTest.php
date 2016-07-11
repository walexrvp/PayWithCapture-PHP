<?php
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\QRCode;
use Tests\ServiceTest;

class QRCodeServiceTest extends ServiceTest
{
  private $productId;

  public function testQRCodeGenerateQRCodeResponseOk()
  {
    $auth = new Authentication($this->clientId, $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $qrClient = new QRCode($token);
    $data = array(
      "merchant_id" => "",
      "amount" => "1000",
      "name" => "riri",
      "description" => "riri for sell",
      "is_amount_locked" => false,
      "image" => base64_encode("blahblahblah")
    );
    $response = $qrClient->generateQRCode($data);
    $this->productId = $response['data']['product_id'];
  }

  public function testGetProductQRCodeResponseOk()
  {
    $auth = new Authentication($this->clientId, $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $qrClient = new QRCode($token);
    $productId =
    $response = $qrClient->getProductQRCode($this->productId);
  }
}

<?php
use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\QRCode;
use PayWithCapture\Services\Logging;

class QRCodeServiceTest extends \PHPUnit_Framework_TestCase
{
  // protected $clientId = "577e5fe42989c31100b26f14";
  // protected $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  // protected $grantType = "client_credentials";
  // protected $username = "darilldrems@gmail.com";
  // protected $password = "jack2211989";
  // protected $log;
  // private $productId;
  //
  // function __construct()
  // {
  //   $this->log = Logging::getLoggerInstance();
  // }
  //
  // public function testQRCodeGenerateQRCodeResponseOk()
  // {
  //   $auth = new Authentication($this->clientId, $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $qrClient = new QRCode($token);
  //   $data = array(
  //     "merchant_id" => "",
  //     "amount" => "1000",
  //     "name" => "riri",
  //     "description" => "riri for sell",
  //     "is_amount_locked" => false,
  //     "image" => base64_encode("blahblahblah")
  //   );
  //   $response = $qrClient->generateQRCode($data);
  //   $this->productId = $response['data']['product_id'];
  //   $this->assertTrue($this->productId);
  // }
  //
  // public function testGetProductQRCodeResponseOk()
  // {
  //   $auth = new Authentication($this->clientId, $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $qrClient = new QRCode($token);
  //   $productId =
  //   $response = $qrClient->getProductQRCode($this->productId);
  // }
}

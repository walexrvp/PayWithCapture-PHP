<?php
namespace PayWithCapture\Services;

class QRCode
{
  private $accessToken;
  private $env;

  /*
  * The class communicates with the QRCode
  * PWC API service
  * This class creates a QRCode client
  * @class QRCode
  * @constructor
  * ```
  * $qrClient = new QRCode($accessToken, $env);
  * ```
  * @param {String} accessToken. Your access_token returned by Authentication
  * @param {String} env optional. You development stage. e.g staging or production
  * @return instance of the class. A client for the merchant using the API.
  */
  function __construct($accessToken, $env = "staging")
  {
    $this->accessToken = $accessToken;
    $this->env = $env;
  }

  /*
  * @method generateQRCode
  * This instance method can be used to generate a QR Code
  * for making payment.
  * ```
  * $qrClient->generateQRCode($params)
  * ```
  * @param {String} $param['merchant_id']. Your merchant account id.
  * @param {String} $param['amount']. Product amount
  * @param {String} $param['name']. Product name
  * @param {String} $param['description'].
  * @param {Boolean} $param['is_amount_locked']
  * @param {String} $param['image']. A base64 encoded image string.
  *
  * @return {Array} $response. An array of json response from the server.
  */
  public function generateQRCode(array $param)
  {
    $response = RequestBuilder::getQRCodeRequestBuilder($this->env)
                                  ->addAccessToken($this->accessToken)
                                  ->addName($param['name'])
                                  ->addMerchantId($param['merchant_id'])
                                  ->addImage($param['image'])
                                  ->addAmount($param['amount'])
                                  ->addDescription($param['description'])
                                  ->addAmountLocked($param['is_amount_locked'])
                                  ->build();
    return $response;
  }

  /*
  * @method getProductQRCode
  * This instance method can be used to fetch QR code
  * for a product whose qr code was already generated
  * ```
  * $qrClient->getProductQRCode($params)
  * ```
  * @param {String} $productId. Your product id in the response of the generateQRCode method.
  *
  * @return {Array} $response. An array of json response from the server.
  */
  public function getProductQRCode($productId)
  {
    $response = RequestBuilder::getQRCodeRequestBuilder($this->env)
                                  ->addAcessToken($this->accessToken)
                                  ->addProductId($productId)
                                  ->build();
    return $response;
  }
}

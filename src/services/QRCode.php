<?php
class namespace PayWithCapture\Services;

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
  * @param {String} $param['merchantId']. Your merchant account id.
  * @param {String} $param['amount']. Product amount
  * @param {String} $param['name']. Product name
  * @param {String} $param['description'].
  * @param {Boolean} $param['amountlocked']
  * @param {String} $param['image']. A base64 encoded image string.
  *
  * @return {Array} $response. An array of json response from the server.
  */
  public function generateQRCode(array $param)
  {

  }

  public function getProductQRCode()
  {

  }
}

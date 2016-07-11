<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Validators\ServerResponseValidator;
use PayWithCapture\Services\ServerData;

/*
* This class is responsible for building the request
* to the PayWithCapture server for an QR Code operations
* @extends ParentBuilder which defined the constructor as well as the
* addAccessToken method which is used to add Authentication access token
* to the request header.
* @class QRCodeRequestBuilder
* @constructor
* ```
*  new QRCodeRequestBuilder($env);
* ```
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class QRCodeRequestBuilder extends ParentBuilder
{

  /*
  * @method addMerchantId
  * @param {String} merchantId. Your account merchant id.
  * @return {QRCodeRequestBuilder} instance so that this method can be chainable
  */
  public function addMerchantId($merchantId)
  {
    $this->session->data['merchant_id'] = $merchantId;
    return $this;
  }

  /*
  * @method addName
  * @param {String} name. Your product name which you need the qr code for.
  * @return {QRCodeRequestBuilder} instance so that this method can be chainable
  */
  public function addName($name)
  {
    $this->session->data['name'] = $name;
    return $this;
  }

  /*
  * @method addDescription
  * @param {String} description.
  * @return {QRCodeRequestBuilder} instance so that this method can be chainable
  */
  public function addDescription($description)
  {
    $this->session->data['description'] = $description;
    return $this;
  }

  /*
  * @method addAmount
  * @param {String} amount.
  * @return {QRCodeRequestBuilder} instance so that this method can be chainable
  */
  public function addAmount($amount)
  {
    $this->session->data['amount'] = $amount;
    return $this;
  }

  /*
  * @method addAmountLocked
  * @param {Boolean} $isAmountLocked.
  * @return {QRCodeRequestBuilder} instance so that this method can be chainable
  */
  public function addAmountLocked($isAmountLocked)
  {
    $this->session->data['amountlocked'] = $isAmountLocked;
    return $this;
  }

  /*
  * @method addImage
  * @param {String} image. A base64 encoded image string for the product.
  * @return {QRCodeRequestBuilder} instance so that this method can be chainable
  */
  public function addImage($image)
  {
    $this->session->data['image'] = $image;
    return $this;
  }

  /*
  * This method is only used in the fetchQRCode method of the QRCode class
  * in PayWithCapture\Services namespace
  * @method addImage
  * @param {String} productId.
  * @return {QRCodeRequestBuilder} instance so that this method can be chainable
  */
  public function addProductId($productId)
  {
    $this->session->data['product_id'] = $productId;
    return $this;
  }

  /*
  * @method build
  * this method builds the request header, data and sends request to the server.
  * @return {array}.Json response from the server in array format.
  */
  public function build(){
    $this->log->info("In QRCodeRequestBuilder");
    $this->log->info("In QRCodeRequestBuilder request data: ".$this->session->data);
    $response = $this->session->post(ServerData::$QR_CODE_PATH);
    ServerResponseValidator::validate($response);
    $this->log->info("In QRCodeRequestBuilder response: ".$response);
    return json_decode($response->body, true);
  }
}

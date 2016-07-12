<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Validators\ServerResponseValidator;

/*
* This class is responsible for building the request
* to the PayWithCapture server for any Otp operation
* @extends ParentBuilder which defined the constructor as well as the
* addAccessToken method which is used to add Authentication access token
* to the request header.
* @class OtpRequestBuilder
* ```
*  new OtpRequestBuilder($env);
* ```
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class OtpRequestBuilder extends ParentBuilder
{
  private $phone;
  private $otpType;

  function __construct($env)
  {
    parent::__construct($env);
  }

  /*
  * private method which builds query and path
  * @method buildQueryUrl
  */
  private function buildQueryUrl(){
    if ($this->otpType == ServerData::$SMS_OTP_TYPE)
      return ServerData::$OTP_PATH . "/" . ServerData::$SMS_OTP_TYPE . "/" . $this->phone;
    return ServerData::$OTP_PATH . "/" . ServerData::$VOICE_OTP_TYPE . "/" . $this->phone;
  }

  /*
  * adds phone to the data to send with the request to the server
  * @method addPhone
  * @param {String} phone.
  * @chainable
  */
  public function addPhone($phone)
  {
    $this->phone = $phone;
    return $this;
  }

  /*
  * adds type to the data to send with the request to the server
  * @method addType
  * @param {String} type. transaction type.
  * @chainable
  */
  public function addType($type)
  {
    $this->otpType = $type;
    return $this;
  }

  /*
  * adds authentication phone number to the data to send with the request to the server
  * this method is only called in the build process when validating an otp
  * @method addPhoneAuth
  * @param {String} phone.
  * @chainable
  */
  public function addPhoneAuth($phone)
  {
    $this->session->data['phonenumber'] = $phone;
    return $this;
  }

  /*
  * adds otp to the data to send with the request to the server
  * this method is only called in the build process when validating an otp
  * @method addOtpAuth
  * @param {String} otp.
  * @chainable
  */
  public function addOtpAuth($otp)
  {
    $this->session->data['otp'] = $otp;
    return $this;
  }

  /*
  * this method builds the request for validating an otp with the PayWithCapture server
  * @method build
  */
  public function buildOtpAuth(){
    $this->log->info("Otp authentication headers: " . json_encode($this->session->headers));
    $this->log->info("Otp authentication data: " . json_encode($this->session->data));
    $response = $this->session->post(ServerData::$OTP_AUTH_PATH);
    $this->log->info("Otp Authentication RequestBuilder build response: ".json_encode($response));
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }

  /*
  * this method builds the request for generating an otp with the PayWithCapture server
  * @method build
  */
  public function build()
  {
    $this->log->info("Otp request headers: ".json_encode($this->session->headers));
    $this->log->info("Otp request params: ".json_encode($this->session->options));
    $url = $this->buildQueryUrl();
    $this->log->info("Otp request path: ".$url);
    $response = $this->session->get($url);
    $this->log->info("Otp RequestBuilder build response: ".json_encode($response));
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }

}

<?php
namespace PayWithCapture\Services;

use PayWithCapture\Services\ServerData;

/*
* This class is responsible for using the OtpRequestBuilder to
* make otp request.
*/
class Otp
{
  private $accessToken;
  private $env;

  /*
  * @class Otp
  * @constructor
  * @param {String} accessToken
  * @param {string} env. Can be staging or production depending on your app stage
  */
  function __construct($accessToken, $env = "staging")
  {
    $this->accessToken = $accessToken;
    $this->env = $env;
  }

  private function sendOtp($type, $phone)
  {
    $response =  RequestBuilder::getOtpRequestBuilder($this->env)
                                  ->addPhone($phone)
                                  ->addType($type)
                                  ->addAccessToken($this->accessToken)
                                  ->build();
    return $response;
  }

  /*
  * this method sends sms otp to designated phone number
  * @method sendSmsOtp
  * @param {String} phone. 2349098090424
  * @returns {Array} response from server
  */
  public function sendSmsOtp($phone)
  {
    return $this->sendOtp(ServerData::$SMS_OTP_TYPE, $phone);
  }

  /*
  * this method sends voice otp to designated phone number
  * @method sendVoiceOtp
  * @param {String} phone. 2349098090424
  * @returns {Array} response from server
  */
  public function sendVoiceOtp($phone)
  {
    return $this->sendOtp(ServerData::$VOICE_OTP_TYPE, $phone);
  }

  /*
  * this method authenticates otp sent to designated phone number
  * @method authenticateOtp
  * @param {String} otp.
  * @param {String} phone. 2349098090424
  * @returns {Array} response from server
  */
  public function authenticateOtp($otp, $phone)
  {
    $response = RequestBuilder::getOtpRequestBuilder($this->env)
                                  ->addPhoneAuth($phone)
                                  ->addOtpAuth($otp)
                                  ->buildOtpAuth();
    return $response;
  }
}

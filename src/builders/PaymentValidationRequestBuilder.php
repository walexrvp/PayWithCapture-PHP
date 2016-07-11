<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Validators\ServerResponseValidator;

/*
* This class is responsible for building the request
* to the PayWithCapture server for any PaymentValidation operation
* @extends ParentBuilder which defined the constructor as well as the
* addAccessToken method which is used to add Authentication access token
* to the request header.
* When a payment is created an otp is sent to the account or card holders telephone number
* this class is then used to validate such payment otps
* @class PaymentValidationRequestBuilder
* ```
*  new PaymentValidationRequestBuilder($env);
* ```
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class PaymentValidationRequestBuilder extends ParentBuilder
{
  /*
  * adds type to the request to the server
  * @method addType
  * @param {String} type.
  * @chainable
  */
  public function addType($type)
  {
    $this->session->data['type'] = $type;
    return $this;
  }

  /*
  * adds otp to the request to the server
  * @method addOtp
  * @param {String} otp.
  * @chainable
  */
  public function addOtp($otp)
  {
    $this->session->data['otp'] = $type;
    return $this;
  }

  /*
  * @method build
  * sends request to the PayWithCapture Server, validates response with
  * ServerResponseValidator, if valid returns response body in array format
  */
  public function build()
  {
    $this->log->info("Transaction request headers: ".json_encode($this->session->headers));
    $this->log->info("Transaction request params: ".json_encode($this->session->options));
    $response = $this->session->post(ServerData::$PAYMENT_VALIDATION_URL);
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }
}

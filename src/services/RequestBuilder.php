<?php
/*
* This class is responsible for building requests
* to PayWithCapture Server
*/
namespace PayWithCapture\Services;

use PayWithCapture\Builders\AuthenticationRequestBuilder;
use PayWithCapture\Builders\TransactionRequestBuilder;
use PayWithCapture\Builders\AccountPaymentRequestBuilder;
use PayWithCapture\Builders\PaymentValidationRequestBuilder;
use PayWithCapture\Builders\CardPaymentRequestBuilder;
use PayWithCapture\Builders\OtpRequestBuilder;
use PayWithCapture\Builders\QRCodeRequestBuilder;

/*
* @class RequestBuilder
* This class is responsible for directly interacting with the PayWithCapture\Builders
* classes.
* It only contains static methods that return instances of the requestbuilder to different
* services provided by PayWithCapture API
*/
class RequestBuilder
{

  /*
  * @class RequestBuilder
  * @static
  * @method getAuthenticationRequestBuilder
  * ```
  * RequestBuilder::getAuthenticationRequestBuilder($env);
  * ```
  * @param {String} $env. Indicates the stage of development.
  * can be staging or production.
  */
  public static function getAuthenticationRequestBuilder($env)
  {
    return new AuthenticationRequestBuilder($env);
  }

  /*
  * @class RequestBuilder
  * @static
  * @method getTransactionRequestBuilder
  * ```
  * RequestBuilder::getTransactionRequestBuilder($env);
  * ```
  * @param {String} $env. Indicates the stage of development.
  * can be staging or production.
  */
  public static function getTransactionRequestBuilder($env)
  {
    return new TransactionRequestBuilder($env);
  }

  /*
  * @class RequestBuilder
  * @static
  * @method getAccountPaymentRequestBuilder
  * ```
  * RequestBuilder::getAccountPaymentRequestBuilder($env);
  * ```
  * @param {String} $env. Indicates the stage of development.
  * can be staging or production.
  */
  public static function getAccountPaymentRequestBuilder($env)
  {
    return new AccountPaymentRequestBuilder($env);
  }

  /*
  * @class RequestBuilder
  * @static
  * @method getPaymentValidationRequestBuilder
  * ```
  * RequestBuilder::getPaymentValidationRequestBuilder($env);
  * ```
  * @param {String} $env. Indicates the stage of development.
  * can be staging or production.
  */
  public static function getPaymentValidationRequestBuilder($env)
  {
    return new PaymentValidationRequestBuilder($env);
  }

  /*
  * @class RequestBuilder
  * @static
  * @method getCardPaymentRequestBuilder
  * ```
  * RequestBuilder::getCardPaymentRequestBuilder($env);
  * ```
  * @param {String} $env. Indicates the stage of development.
  * can be staging or production.
  */
  public static function getCardPaymentRequestBuilder($env)
  {
    return new CardPaymentRequestBuilder($env);
  }

  /*
  * @class RequestBuilder
  * @static
  * @method getOtpRequestBuilder
  * ```
  * RequestBuilder::getOtpRequestBuilder($env);
  * ```
  * @param {String} $env. Indicates the stage of development.
  * can be staging or production.
  */
  public static function getOtpRequestBuilder($env)
  {
    return new OtpRequestBuilder($env);
  }

  /*
  * @class RequestBuilder
  * @static
  * @method getQRCodeRequestBuilder
  * ```
  * RequestBuilder::getQRCodeRequestBuilder($env);
  * ```
  * @param {String} $env. Indicates the stage of development.
  * can be staging or production.
  */
  public static function getQRCodeRequestBuilder($env)
  {
    return new QRCodeRequestBuilder($env);
  }


}

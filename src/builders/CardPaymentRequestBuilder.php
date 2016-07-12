<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Validators\ServerResponseValidator;
use PayWithCapture\Services\ServerData;

/*
* This class is responsible for building the request
* to the PayWithCapture server for any Card Payment operation
* @extends ParentBuilder which defined the constructor as well as the
* addAccessToken method which is used to add Authentication access token
* to the request header.
* @class AuthenticationRequestBuilder
* ```
*  new CardPaymentRequestBuilder($env);
* ```
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class CardPaymentRequestBuilder extends ParentBuilder
{
    /*
    * @class CardPaymentRequestBuilder
    * @constructor
    */
    function __construct($env)
    {
      parent::__construct($env);
    }

    /*
    * adds type to the data to send with the request to the server
    * @method addType
    * @param {String} type. transaction type. can be card or account
    * @chainable
    */
    public function addType($type)
    {
      $this->session->data['type'] = $type;
      return $this;
    }

    /*
    * adds amount to the data to send with the request to the server
    * @method addAmount
    * @param {Number} amount.
    * @chainable
    */
    public function addAmount($amount)
    {
      $this->session->data['amount'] = $amount;
      return $this;
    }

    /*
    * adds cvv to the data to send with the request to the server
    * @method addCvv
    * @param {String} cvv. Card cvv
    * @chainable
    */
    public function addCvv($cvv)
    {
      $this->session->data['cvv'] = $cvv;
      return $this;
    }

    /*
    * adds description to the data to send with the request to the server
    * @method addDescription
    * @param {String} desc.
    * @chainable
    */
    public function addDescription($desc)
    {
      $this->session->data['description'] = $desc;
      return $this;
    }

    /*
    * adds Transaction id to the data to send with the request to the server
    * @method addTransactionId
    * @param {String} trans.
    * @chainable
    */
    public function addTransactionId($trans)
    {
      $this->session->data['transaction_id'] = $trans;
      return $this;
    }

    /*
    * adds merchant id to the data to send with the request to the server
    * @method addMerchantId
    * @param {String} merchant.
    * @chainable
    */
    public function addMerchantId($merchant)
    {
      $this->session->data['merchant_id'] = $merchant;
      return $this;
    }

    /*
    * adds pin to the data to send with the request to the server
    * @method addPin
    * @param {String} pin.
    * @chainable
    */
    public function addPin($pin)
    {
      if (!empty($pin))
        $this->session->data['pin'] = $pin;
      return $this;
    }

    /*
    * adds bvn to the data to send with the request to the server
    * @method addBvn
    * @param {String} bvn.
    * @chainable
    */
    public function addBvn($bvn)
    {
      if (!empty($bvn))
        $this->session->data['bvn'] = $bvn;
      return $this;
    }

    /*
    * adds redirect url to the data to send with the request to the server
    * @method addRedirectUrl
    * @param {String} url.
    * @chainable
    */
    public function addRedirectUrl($url)
    {
      if (!empty($url))
        $this->session->data['redirect_url'] = $url;
      return $this;
    }

    /*
    * adds card number to the data to send with the request to the server
    * @method addCardNo
    * @param {String} cardNo.
    * @chainable
    */
    public function addCardNo($cardNo)
    {
      $this->session->data['cardno'] = $cardNo;
      return $this;
    }

    /*
    * adds year to the data to send with the request to the server
    * @method addYear
    * @param {String} yr.
    * @chainable
    */
    public function addExpYear($yr)
    {
      $this->session->data['expyear'] = $yr;
      return $this;
    }

    /*
    * adds expiry month to the data to send with the request to the server
    * @method addExpMnth
    * @param {String} type. transaction type. can be card or account
    * @chainable
    */
    public function addExpMnth($expMonth)
    {
      $this->session->data['expmth'] = $expMonth;
      return $this;
    }

    /*
    * builds the request to send to the server.
    * validates the response with ServerResponseValidator, if no error returns
    * an array representation of the server response body
    * @method build
    * @return array response
    */
    public function build()
    {
      $this->log->info("CardPayment headers: ".json_encode($this->session->headers));
      $this->log->info("Card payment data: ".json_encode($this->session->data));
      $this->log->info("Card payment path: ".ServerData::$PAYMENT_PATH);
      $response = $this->session->post(ServerData::$PAYMENT_PATH);
      $this->log->info("CardPaymentBuilder build response: ".json_encode($response));
      ServerResponseValidator::validate($response);
      return $response;
    }
}

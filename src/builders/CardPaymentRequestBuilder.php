<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Validators\ServerResponseValidator;
use PayWithCapture\Services\ServerData;

class CardPaymentRequestBuilder extends ParentBuilder
{
    function __construct($env)
    {
      parent::__construct($env);
    }

    public function addType($type)
    {
      $this->session->data['type'] = $type;
      return $this;
    }

    public function addAmount($amount)
    {
      $this->session->data['amount'] = $amount;
      return $this;
    }

    public function addCvv($cvv)
    {
      $this->session->data['cvv'] = $cvv;
      return $this;
    }

    public function addDescription($desc)
    {
      $this->session->data['description'] = $desc;
      return $this;
    }

    public function addTransactionId($trans)
    {
      $this->session->data['transaction_id'] = $trans;
      return $this;
    }

    public function addMerchantId($merchant)
    {
      $this->session->data['merchant_id'] = $merchant;
      return $this;
    }

    public function addPin($pin)
    {
      if (!empty($pin))
        $this->session->data['pin'] = $pin;
      return $this;
    }

    public function addBvn($bvn)
    {
      if (!empty($bvn))
        $this->session->data['bvn'] = $bvn;
      return $this;
    }

    public function addRedirectUrl($url)
    {
      if (!empty($url))
        $this->session->data['redirect_url'] = $url;
      return $this;
    }

    public function addCardNo($cardNo)
    {
      $this->session->data['cardno'] = $cardNo;
      return $this;
    }

    public function addExpYear($yr)
    {
      $this->session->data['expyear'] = $yr;
      return $this;
    }

    public function addExpMnth($expMonth)
    {
      $this->session->data['expmth'] = $expMonth;
      return $this;
    }

    public function build()
    {
      $this->log->info("CardPayment headers: ".json_encode($this->session->headers));
      $this->log->info("Card payment data: ".json_encode($this->session->data));
      $this->log->info("Card payment path: ".ServerData::$PAYMENT_PATH);
      $response = $this->session->post(ServerData::$PAYMENT_PATH);
      $this->log->info("CardPaymentBuilder build response: ".json_encode($response));
      ServerResponseValidator::validate($response);
      return json_decode($response->body, true);
    }
}

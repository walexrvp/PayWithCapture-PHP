<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Logging;
use PayWithCapture\Parsers\AuthenticationResponse;

class AuthenticationRequestBuilder extends ParentBuilder
{
  private $authUrl;

  /*
  * @param $env string can be "staging" or "production"
  */
  function __construct($env)
  {
    parent::__construct($env);
  }

  public function addClientId($val)
  {
    $this->session->data['client_id'] = $val;
    return $this;
  }

   function addClientSecret($val)
  {
    $this->session->data['client_secret'] = $val;
    return $this;
  }

  public function addGrantType($val)
  {
    $this->session->data['grant_type'] = $val;
    return $this;
  }

  public function addUserName($val)
  {
    if (!empty($val))
      $this->session->data['username'] = $val;
    return $this;
  }

  public function addPassword($val)
  {
    if (!empty($val))
      $this->session->data['password'] = $val;
    return $this;
  }

  public function addRefreshToken($val)
  {
    $this->session->data['refresh_token'] = $val;
    return $this;
  }

  private function validateGrantType()
  {
    if ($this->session->data['grant_type'] != ServerData::$DEFAULT_GRANT_TYPE) {
      if (!$this->session->data['username'] || !$this->session->data['password'])
        throw new Exception(""); //TODO: throw invalid auth parameters exception
    }

  }

  public function build()
  {
    $this->validateGrantType();
    $this->log->info("Authentication path is: ".ServerData::$AUTHENTICATION_PATH);
    $this->log->info("Authentication request body: ".json_encode($this->session->data));
    $response = $this->session->post(ServerData::$AUTHENTICATION_PATH);
    $this->log->info("Authentication response: ".json_encode($response));
    $response = AuthenticationResponse::parseAuthenticationResponse($response);
    return $response;
  }
}

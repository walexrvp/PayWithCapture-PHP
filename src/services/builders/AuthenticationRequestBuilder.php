<?php
namespace PayWithCapture\Services\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Logging;
use PayWithCapture\Services\Parsers\AuthenticationResponse;

class AuthenticationRequestBuilder
{
  private $authUrl;

  private $log;

  /*
  * @param $env string can be "staging" or "production"
  */
  function __construct($env)
  {
    $this->session = new \Requests_Session(ServerData::$BASE_URL[$env]);
    $this->log = Logging::getLoggerInstance();
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

  public function build()
  {
    $this->log->info("Authentication path is ".ServerData::$AUTHENTICATION_PATH);
    $response = $this->session->post(ServerData::$AUTHENTICATION_PATH);
    $response = AuthenticationResponse::parseAuthenticationResponse($response);
    return $response;
  }
}

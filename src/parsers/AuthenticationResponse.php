<?php
namespace PayWithCapture\Parsers;

use PayWithCapture\Services\Logging;

class AuthenticationResponse
{

  private $tokenType;
  private $accessToken;
  private $expiresIn;
  private $refreshToken;
  private $log;

  function __construct()
  {
    $this->log = Logging::getLoggerInstance();
  }

  public function getTokenType()
  {
    return $this->tokenType;
  }

  public function getAccessToken()
  {
    return $this->accessToken;
  }

  public function getExpiresIn()
  {
    return $this->expiresIn;
  }

  public function getRefreshToken()
  {
    return $this->refreshToken;
  }

  /*
  * This method will convert the response from the server into
  * a AuthenticationResponse type or throw an exception if any error
  * occurs
  */
  public static function parseAuthenticationResponse($response)
  {
    if ($response->status_code == 404)
      throw new Exception(""); //TODO change exception to custom 404 exception

    // TODO: other errors that can occur should be caught here

    $responseArrayFormat = json_decode($response->body, true);
    $authResponse = new AuthenticationResponse();
    $authResponse->accessToken = $responseArrayFormat['access_token'];
    $authResponse->expiresIn = $responseArrayFormat['expires_in'];
    $authResponse->refreshToken = $responseArrayFormat['refresh_token'];
    return $authResponse;
  }

}

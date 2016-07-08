<?php
/*
* This class is responsible for managing request to Authorization endpoint
* please always call loadAccessToken before getAccessToken
*/
namespace PayWithCapture\Services;

class Authentication
{
  private $clientId;
  private $clientSecret;
  private $grantType;
  private $userName;
  private $password;
  private $refreshToken;
  private $accessTokenExpirationTimeInSeconds;
  private $accessToken;

  /*
  * this variable will be used to tell Authentication and others if in development stage
  * or in producation stage.
  * possible values are either staging or production
  */
  private $env;

  function __construct($clientId, $clientSecret, $grantType, $env="staging", $eagerLoading=false, $username="", $password="") {
    $this->clientId = $clientId;
    $this->clientSecret = $clientSecret;
    $this->grantType = $grantType;
    $this->username = $username;
    $this->password = $password;
    $this->env = $env;

    if ($eagerLoading)
      $this->fetchAccessToken();
  }

  public function getAccessToken()
  {
    return $this->accessToken;
  }

  public function loadAccessToken()
  {
    if ($this->getAccessToken()) {
      if ($this->isAccessTokenExpired())
      {
        $this->refetchAccessToken();
      }
    }else {
      $this->fetchAccessToken();
    }
  }

  private function isAccessTokenExpired($token)
  {
    $paddingInSeconds = 10; //this value is used for padding time to prevent errors
    $now = time() - $paddingInSeconds;
    if ($now >=  $this->getAccessTokenExpirationTimeInSeconds())
      return true;
    return false;
  }

  private function fetchAccessToken()
  {
    $this->validateFetchTokenRequiredValues();
    $response = RequestBuilder::getAuthenticationRequestBuilder($this->env)
                  ->addClientId($this->clientId)
                  ->addClientSecret($this->clientSecret)
                  ->addGrantType($this->grantType)
                  ->addUserName($this->userName)
                  ->addPassword($this->password)
                  ->build();
    $this->setRefreshToken($response->getRefreshToken());
    $this->setAccessToken($response->getAccessToken());
    $this->setAccessTokenExpirationTimeInSeconds($response->getExpiresIn());
  }


  //TODO: persist both accessToken and accessTokenLastFetchedTimeTimestamp
  //to file system so it can be re used if it has not expired btw requests.


  private function setAccessTokenExpirationTimeInSeconds($expiresIn)
  {
    //add the expiresIn (seconds) to current time to get time in seconds it is expired
    $this->accessTokenExpirationTimeInSeconds = (int) $expiresIn + time();
  }

  private function getAccessTokenExpirationTimeInSeconds()
  {
    return $this->accessTokenExpirationTimeInSeconds;
  }

  private function refetchAccessToken()
  {
    $this->validateRefetchTokenRequiredValues();
    $response = RequestBuilder::getAuthenticationRequestBuilder()
                  ->addRefreshToken(getRefreshToken())
                  ->build();
    $this->setRefreshToken($response->getRefreshToken());
    $this->setAccessToken($response->getAccessToken());
    $this->setAccessTokenExpirationTimeInSeconds($response->getExpiresIn());
  }

  private function validateFetchTokenRequiredValues()
  {
    empty($this->clientId) ? "TODO:throw exception here" : true;
    empty($this->clientSecret) ? "TODO:throw exception here" : true;
    empty($this->grantType) ? "TODO:throw exception here" : true;
  }

  private function validateRefetchTokenRequiredValues()
  {
    empty($this->refreshToken) ? "TODO:throw exception here" : true;
  }

  private function setRefreshToken($token)
  {
    $this->refreshToken = $token;
  }

  private function getRefreshToken(){
    return $this->refreshToken;
  }

  private function setAccessToken($token)
  {
    $this->accessToken = $token;
  }

}

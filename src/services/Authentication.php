<?php
/*
* This class is responsible for managing AuthenticationRequestBuilder.
* please always call loadAccessToken before getAccessToken
*/
namespace PayWithCapture\Services;

class Authentication
{
  private $clientId;
  private $clientSecret;
  private $userName;
  private $password;
  private $refreshToken;
  private $accessTokenExpirationTimeInSeconds;
  private $accessToken;

  private $log;

  /*
  * this variable will be used to tell Authentication and others if in development stage
  * or in producation stage.
  * possible values are either staging or production
  */
  private $env;

  /*
  * @class Authentication
  * @constructor
  * ```
  *  new Authentication($accessToken, $env);
  * ```
  * @param {String} clientId. Your devcenter clientId
  * @param {String} clientSecret. Your devcenter clientSecret
  * @param {String} optional $env. This indicate the level of development. When in development use staging
  * and when in live or production use production.
  * @param {String} eagerLoading false or true. Use false so server request for token only happens later on
  * @param {String} username. Your devcenter username
  * @param {String} password. Your devcenter password
  *
  */
  function __construct($clientId, $clientSecret, $env="staging", $eagerLoading=false, $username="", $password="") {
    $this->clientId = $clientId;
    $this->clientSecret = $clientSecret;
    $this->userName = $username;
    $this->password = $password;
    $this->env = $env;

    $this->log = Logging::getLoggerInstance();

    if ($eagerLoading)
      $this->fetchAccessToken();
  }

  /*
  * @method getAccessToken
  * @returns accessToken
  */
  public function getAccessToken()
  {
    return $this->accessToken;
  }

  /*
  * @method loadAccessToken
  * This method checks if accessTOken is set and not expired.
  * If not set it fetches the accessToken from the server
  */
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

  /*
  * Uses the AuthenticationRequestBuilder to fetch accessToken from the server
  */
  private function fetchAccessToken()
  {
    $this->validateFetchTokenRequiredValues();
    //this section determines which grantType to use for authentication
    $usePasswordGrantType = ($this->userName && $this->password);
    $grantType = $usePasswordGrantType ? ServerData::$PASSWORD_GRANT_TYPE : ServerData::$DEFAULT_GRANT_TYPE;
    $this->log->info("Grant type for fetchAccessToken: ".$grantType);
    $response = RequestBuilder::getAuthenticationRequestBuilder($this->env)
                  ->addClientId($this->clientId)
                  ->addClientSecret($this->clientSecret)
                  ->addGrantType($grantType)
                  ->addUserName($this->userName)
                  ->addPassword($this->password)
                  ->build();
    $this->setRefreshToken($response['refresh_token']);
    $this->setAccessToken($response['access_token']);
    $this->setAccessTokenExpirationTimeInSeconds($response['expires_in']);
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
    $this->setRefreshToken($response['refresh_token']);
    $this->setAccessToken($response['access_token']);
    $this->setAccessTokenExpirationTimeInSeconds($response['expires_in']);
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

<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\ServerData;
use PayWithCapture\Services\Logging;
use PayWithCapture\Validators\ServerResponseValidator;

/*
* This class is responsible for building the request
* to the PayWithCapture server for any Authentication operation
* @extends ParentBuilder which defined the constructor as well as the
* addAccessToken method which is used to add Authentication access token
* to the request header.
* @class AuthenticationRequestBuilder
* ```
*  new AuthenticationRequestBuilder($env);
* ```
* @param {String} $env. This is the stage of development.
* can be staging or production.
*/
class AuthenticationRequestBuilder extends ParentBuilder
{
  private $authUrl;

  /*
  * @class AuthenticationRequestBuilder
  * @constructor
  * @param {String} $env can be "staging" or "production"
  */
  function __construct($env)
  {
    parent::__construct($env);
  }

  /*
  * adds clientId to the data to send with the request to the server
  * Your clientId is available in your devcenter settings page
  * @method addClientId
  * @param {String} $val. client id
  * @chainable
  */
  public function addClientId($val)
  {
    $this->session->data['client_id'] = $val;
    return $this;
  }

  /*
  * adds clientSecret to the data to send with the request to the server
  * Your clientSecret is available in your devcenter setting page
  * @method addClientSecret
  * @param {String} $val. client id
  * @chainable
  */
   function addClientSecret($val)
  {
    $this->session->data['client_secret'] = $val;
    return $this;
  }

  /*
  * adds addGrentType to the data to send with the request to the server
  * @method addGrantType
  * @param {String} $val. client id
  * @chainable
  */
  public function addGrantType($val)
  {
    $this->session->data['grant_type'] = $val;
    return $this;
  }

  /*
  * adds username to the data to send with the request to the server
  * @method addUserName
  * @param {String} $val. client id, this parameter is optional
  * @chainable
  */
  public function addUserName($val)
  {
    if (!empty($val))
      $this->session->data['username'] = $val;
    return $this;
  }

  /*
  * adds password to the data to send with the request to the server
  * the password value is optional for authentication
  * @method addPassword
  * @param {String} $val. client id
  * @chainable
  */
  public function addPassword($val)
  {
    if (!empty($val))
      $this->session->data['password'] = $val;
    return $this;
  }

  /*
  * adds refresh_token to the data to send with the request to the server
  * @method addRefreshToken
  * @param {String} $val. The refresh_token which is supplied the first time
  * authentication is attempted successfully
  * @chainable
  */
  public function addRefreshToken($val)
  {
    $this->session->data['refresh_token'] = $val;
    return $this;
  }

  /*
  * validates grant type to use for the request depending on the values available.
  * if username and password avialbale it will use the password grant type However
  * if only clientId and clientSecret is provided then it will use access_credentials
  * as the grant type
  * @method addGrantType
  * @private
  */
  private function validateGrantType()
  {
    if ($this->session->data['grant_type'] != ServerData::$DEFAULT_GRANT_TYPE) {
      if (!$this->session->data['username'] || !$this->session->data['password'])
        throw new Exception(""); //TODO: throw invalid auth parameters exception
    }

  }

  /*
  * builds the request data and sends it to the PayWithCapture Authentication
  * server.
  * @method build
  * This method sends the request to the server, then validates the response with
  * ServerResponseValidator::validate method, if no error it returns the response body
  * in array format
  */
  public function build()
  {
    $this->validateGrantType();
    $this->log->info("Authentication path is: ".ServerData::$AUTHENTICATION_PATH);
    $this->log->info("Authentication request body: ".json_encode($this->session->data));
    $response = $this->session->post(ServerData::$AUTHENTICATION_PATH);
    $this->log->info("Authentication response: ".json_encode($response));
    ServerResponseValidator::validate($response);
    return json_decode($response->body, true);
  }
}

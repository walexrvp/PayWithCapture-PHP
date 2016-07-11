<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\Logging;
use PayWithCapture\Services\ServerData;

/*
* This is an abstract builder class that encapsulates the methods common to all
* request builders in the PayWithCapture\Builders namespace
*/
abstract class ParentBuilder
{
  protected $log;
  protected $session;

  /*
  * @class ParentBuilder
  * @constructor
  */
  function __construct($env)
  {
    $this->log = Logging::getLoggerInstance();
    $this->log->info("Builder base url: ".ServerData::$BASE_URL[$env]);
    $this->session = new \Requests_Session(ServerData::$BASE_URL[$env]);
  }

  /*
  * sets Authentication header for the request to the PayWithCapture Server
  * e.g Authorization: Bearer [accessToken]
  * @method addAccessToken
  * @param {String} accessToken. This accessToken is provided from the Authentication class.
  * @chainable
  */
  public function addAccessToken($accessToken)
  {
    $this->session->headers['Authorization'] = ServerData::$BEARER.$accessToken;
    return $this;
  }

}

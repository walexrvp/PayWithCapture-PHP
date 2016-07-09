<?php
namespace PayWithCapture\Builders;

use PayWithCapture\Services\Logging;
use PayWithCapture\Services\ServerData;

class ParentBuilder
{
  protected $log;
  protected $session;

  function __construct($env)
  {
    $this->log = Logging::getLoggerInstance();
    $this->log->info("Builder base url: ".ServerData::$BASE_URL[$env]);
    $this->session = new \Requests_Session(ServerData::$BASE_URL[$env]);
  }

  public function addAccessToken($accessToken)
  {
    $this->session->headers['Authorization'] = ServerData::$BEARER.$accessToken;
    return $this;
  }

}

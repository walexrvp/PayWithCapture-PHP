<?php
namespace PayWithCapture\Parsers;

use PayWithCapture\Services\Logging;

class ServerResponseValidator
{
  private static $log;

  private static function init()
  {
    self::$log = Logging::getLoggerInstance();
  }

  /*
  * This function is responsible for validating Htt response
  * from the server. If any errors, it throws exceptions for the errors.
  * @param RequestResponse
  * @return void
  */
  private static function validate($response)
  {
    self::init();
    self::$log->info("Account Payment Server Response: ".$response->body);

    if ($response->status_code == 404)
      throw new Exception(""); //TODO: throw not found exception

    if ($response->status_code == 401)
      throw new Exception(""); //TODO: unauthorized access exception

    if ($response->status_code == 403)
      throw new Exception(""); //TODO: unauthorized access Exception

    $responseInArrayFormat = json_decode($response->body, true);

    if ($responseInArrayFormat['status'] == "error")
      throw new Exception(""); //TODO: throw invalid request exception and display message
  }

}

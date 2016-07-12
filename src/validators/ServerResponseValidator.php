<?php
namespace PayWithCapture\Validators;

use PayWithCapture\Services\Logging;
use PayWithCapture\Errors\ForbiddenRequestException;
use PayWithCapture\Errors\InvalidRequestException;
use PayWithCapture\Errors\NotFoundException;
use PayWithCapture\Errors\ServerUnavailableException;
use PayWithCapture\Errors\UnAuthorizedException;
/*
* After a particuler request builder returns the server response
* it passes the response to validate method of this class to validate if
* any error occur. If any errors occur the validate method will throw the appropriate
* exception.
*/
class ServerResponseValidator
{
  private static $log;

  private static function init()
  {
    self::$log = Logging::getLoggerInstance();
  }

  /*
  * @class ServerResponseValidator
  * @static
  * This function is responsible for validating Htt response
  * from the server. If any errors, it throws exceptions for the errors.
  * @param RequestResponse
  * @return void
  */
  public static function validate($response)
  {
    self::init();
    self::$log->info("Account Payment Server Response: ".$response->body);

    if ($response->status_code == 500)
      throw new ServerUnAvailableException();

    if ($response->status_code == 404)
      throw new NotFoundException();

    if ($response->status_code == 401)
      throw new UnAuthorizedException();

    if ($response->status_code == 403)
      throw new ForbiddenRequestException();

    $responseInArrayFormat = json_decode($response->body, true);

    if ($responseInArrayFormat['status'] == "error")
      throw new InvalidRequestException();
  }

}

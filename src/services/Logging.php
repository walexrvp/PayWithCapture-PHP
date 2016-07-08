<?php
/*
* A singleton class for logging.
* This class also helps to wrap arround logging function nality so that
* when the logger is changed implementation is not changed in other
* parts of the code
*/
namespace PayWithCapture\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Logging
{
  private $log;

  private function __construct()
  {
    $this->log = new Logger('General');
    $this->log->pushHandler(new StreamHandler(__DIR__.'/paywithcapture.log', Logger::INFO));

  }

  public static function getLoggerInstance()
  {
    return new Logging();
  }

  public function warning($message, array $context = [])
  {
    $this->log->warning($message, $context);
  }

  public function notice($message, $context = [])
  {
    $this->log->notice($message, $context);
  }

  public function error($message, $context = [])
  {
    $this->log->error($message, $context);
  }

  public function debug($message, $context = [])
  {
    $this->log->debug($message, $context);
  }

  public function info($message, $context = [])
  {
    $this->log->info($message, $context);
  }

}

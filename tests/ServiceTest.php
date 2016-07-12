<?php
namespace Tests;

use PayWithCapture\Services\Logging;

abstract class ServiceTest extends \PHPUnit_Framework_TestCase
{
  protected $clientId = "577e5fe42989c31100b26f14";
  protected $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  protected $grantType = "client_credentials";
  protected $username = "darilldrems@gmail.com";
  protected $password = "jack2211989";
  protected $log;

  function __construct()
  {
    $this->log = Logging::getLoggerInstance();
  }
}

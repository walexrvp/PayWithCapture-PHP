<?php

use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\Logging;

class AuthenticationServiceTest extends \PHPUnit_Framework_TestCase
{
  // protected $clientId = "577e5fe42989c31100b26f14";
  // protected $clientSecret = "diHopa8yFNDWofRNJIeREDmAV3HhL7bwr4umhlhPS0CgqIiOylA6Y9obfsV9VsbWBDuMUKE7MvVpIrtip4oX8zmG21I4QI1rhwjx";
  // protected $grantType = "client_credentials";
  // protected $username = "darilldrems@gmail.com";
  // protected $password = "jack2211989";
  // protected $log;
  //
  // function __construct()
  // {
  //   $this->log = Logging::getLoggerInstance();
  // }
  // public function testAccessTokenNotEmptyWithClientCredentials()
  // {
  //   $auth = new Authentication($this->clientId,
  //                               $this->clientSecret);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $this->log->info("ACCESS TOKEN : ".$token);
  //   $this->assertTrue(!empty($token));
  // }
  //
  // public function testAccessTokenNotEmptyWithUserNamePassword()
  // {
  //   $auth = new Authentication($this->clientId,
  //                               $this->clientSecret, "staging", false, $this->username, $this->password);
  //   $auth->loadAccessToken();
  //   $token = $auth->getAccessToken();
  //   $this->log->info("ACCESS TOKEN : ".$token);
  //   $this->assertTrue(!empty($token));
  //
  // }
}

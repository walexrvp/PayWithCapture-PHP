<?php

use PayWithCapture\Services\Authentication;
use PayWithCapture\Services\Logging;

class AuthenticationServiceTest extends ServiceTest
{
  public function testAccessTokenNotEmptyWithClientCredentials()
  {
    $auth = new Authentication($this->clientId,
                                $this->clientSecret);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $this->log->info("ACCESS TOKEN : ".$token);
    $this->assertTrue(!empty($token));
  }

  public function testAccessTokenNotEmptyWithUserNamePassword()
  {
    $auth = new Authentication($this->clientId,
                                $this->clientSecret, "staging", false, $this->username, $this->password);
    $auth->loadAccessToken();
    $token = $auth->getAccessToken();
    $this->log->info("ACCESS TOKEN : ".$token);
    $this->assertTrue(!empty($token));

  }
}

<?php
namespace PayWithCapture\Services;

class ServerData
{
  public static $BASE_URL = array(
    "staging" => "https://pwcstaging.herokuapp.com/",
    "production" => ""
  );

  public static $AUTHENTICATION_PATH = "/oauth/token";

  public static $DEFAULT_GRANT_TYPE = "client_credentials";
}

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

  public static $PASSWORD_GRANT_TYPE = "password";

  public static $TRANSACTION_QUERY_PATH = "/orders/transactions";

  public static $BEARER = "Bearer ";

  public static $STAGING = "staging";

  public static $PRODUCTION = "production";
}

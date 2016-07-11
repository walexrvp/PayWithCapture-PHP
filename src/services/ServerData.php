<?php
namespace PayWithCapture\Services;

class ServerData
{
  public static $BASE_URL = array(
    "staging" => "https://pwcstaging.herokuapp.com/",
    "production" => ""
  );

  public static $AUTHENTICATION_PATH = "/oauth/token";
  public static $OTP_PATH = "/otp";
  public static $OTP_AUTH_PATH = "/otp/authenticate";
  public static $PAYMENT_VALIDATION_URL = "/orders/validatePayment";
  public static $QR_CODE_PATH = "/products/getQrCode";
  public static $TRANSACTION_QUERY_PATH = "/orders/transactions";
  public static $PAYMENT_PATH = "/orders/oneOffPayment";

  public static $DEFAULT_GRANT_TYPE = "client_credentials";

  public static $PASSWORD_GRANT_TYPE = "password";

  public static $ACCOUNT_PAYMENT_TYPE = "account";
  public static $CARD_PAYMENT_TYPE = "card";

  public static $CARD_PAYMENT = "oneOffCard";
  public static $ACCOUNT_PAYMENT = "oneOffAccount";

  public static $VOICE_OTP_TYPE = "voice";
  public static $SMS_OTP_TYPE = "sms";

  public static $BEARER = "Bearer ";

  public static $STAGING = "staging";

  public static $PRODUCTION = "production";


}

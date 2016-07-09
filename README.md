# PayWithCapture-PHP
The PayWithCapture PHP lets you write PHP code to consume PayWithCapture APIs

You can signup for a PayWithCapture developer account at [PayWithCapture DevCenter](https://pwcdevcenter.herokuapp.com)

## Requirements
PHP 5.3.3 and later

## Composer
You can install PayWithCapture-PHP via (composer)[https://getcomposer.org/]
```
 composer require paywithcapture/paywithcapture-php
```

## Manual Installation
Please try not to install manually as there are many dependencies you will need to manage. However,
if you insist on installing manually then check the composer.php file for dependencies and check the dependencies of the projects depended on.

## Getting Started
To use, first create an instance of the PayWithCaptureClient class. This class is responsible for
providing clients to other services provided by PayWithCapture API.
'''
//this library also manages authentication for you
$client = new PayWithCaptureClient($clientId, $clientSecret,
                    $env //optional, $eagerLoading //optional, $username //optional, $password //optional);
'''
When you register as a developer on PayWithCapture DevCenter, you will receive a clientId and clientSecret
for Authentication. When in development stage the $env variable will be set to `staging`.

Set $eagerLoading variable to false if you want Authentication to happen only when you make a request to the server or false if you want authentication to happen when you instantiated the PayWithCaptureClient class.

The $username and $password variables are used if you intend to authenticate you API with your developer account username and password.

### PayWithCapture API Services
+ __Account Payment__
+ __Card Payment__
+ __Transactions__
+ __POS Printing__
+ __QR CODES__
+ __BVN BANK ACCOUNT VERIFICATION__

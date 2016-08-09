# PayWithCapture-PHP
The PayWithCapture PHP lets you write PHP code to consume PayWithCapture APIs

You can signup for a PayWithCapture developer account at [PayWithCapture DevCenter](https://pwcdevcenter.herokuapp.com)

### PayWithCapture API Services
+ __Transactions__
+ __POS Printing__
+ __QR CODES__

## Requirements
PHP 5.3.3 and later

## Composer
You can install PayWithCapture-PHP via [composer](https://getcomposer.org/)
```
 composer require paywithcapture/paywithcapture-php
```

## Manual Installation
Please try not to install manually as there are many dependencies you will need to manage. However,
if you insist on installing manually then check the dependencies of the projects depended on, and the dependencies of the depended on projects and so on.


## Getting Started
To use, first create an instance of the PayWithCaptureClient class. This class is responsible for
providing clients to other services provided by PayWithCapture API. For more comperensive tutorials
open the [example folder](https://github.com/PayWC/PayWithCapture-PHP/tree/master/examples)

```PHP
//recommended approach
$client = new PayWithCaptureClient($clientId, $clientSecret);

//extended usage
$client = new PayWithCaptureClient($clientId, $clientSecret, $env //optional,
               $eagerLoading //optional, $username //optional, $password //optional);

//for more information open the examples folder
```
When you register as a developer on PayWithCapture DevCenter, you will get a clientId and clientSecret
for Authentication. When in development stage the $env variable should be set to `staging`.

Set $eagerLoading variable to false if you want Authentication to happen only when you make a request to the server or false if you want authentication to happen when you instantiated the PayWithCaptureClient class.

The $username and $password variables are used if you intend to authenticate your API requests with your developer account username and password.

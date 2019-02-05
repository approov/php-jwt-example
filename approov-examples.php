#!/usr/bin/env php
<?php
require 'vendor/autoload.php';

use \Firebase\JWT\JWT;

$validApproovJwtToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJjdXN0b20iLCJwYXkiOiJmM1UyZm5pQkpWRTA0VGRlY2owZDZvclY5cVQ5dDUyVGpmSHhkVXFEQmdZPSIsImV4cCI6MzMwODM3MzE4OTZ9.69pKY5GYD6rUhEGSmnFOa4nze9Z9pEHkg-sv3R88sWQ';

// This is the Approov base64 secret downloaded from the Approov portal.
// That in production you want to retrieve from a .env file:
//$approovBase64Secret = getenv('APPROOV_BASE64_SECRET');
$approovBase64Secret = 'YXBwcm9vdi1iYXNlNjQtZW5jb2RlZC1zZWNyZXQ=';
$approovSecret = base64_decode($approovBase64Secret);


// Lets's try to decode with several scenarios in mind...

echo "\n\n---> Try to decode with an empty Approov Secret <---\n";
decodeApproovJwtToken($validApproovJwtToken, '');

echo "\n\n---> Try to decode with an empty Approov JWT Token <---\n";
decodeApproovJwtToken('', $approovSecret);

echo "\n\n---> Try to decode with a malformed Approov JWT token <---\n";
$malformedApproovToken = 'sdasadsadf.trtrtryryt.yutyutyyuty';
decodeApproovJwtToken($malformedApproovToken, $approovSecret);

echo "\n\n---> Try to decode with an expired Approov JWT token <---\n";
$expiredApproovToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJjdXN0b20iLCJleHAiOjE1NDgwODk3ODB9.DyVoiOX6h4pxB9gmxQlIMKKJzm1LZj4Nmmxlb018X5M';
decodeApproovJwtToken($expiredApproovToken, $approovSecret);

echo "\n\n---> Try to decode with an Approov JWT token signed with an unknown secret <---\n";
$expiredApproovToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1NDkzODI4MjcsImV4cCI6MTgxNTQ5MzgyODI3fQ.RTSE9YeJlDd21YYi7Mt-eSnPx0Vkzi83ZRnqKUBRWaM';
decodeApproovJwtToken($expiredApproovToken, $approovSecret);

echo "\n\n---> Decode a Valid Approov JWT token <---\n";
// This token is valid because is signed with the same secret used by the Approov cloud service, that in production MUST be downloaded from the
// Approov portal and provided via a .env file.
$expiredApproovToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJjdXN0b20iLCJleHAiOjE1NDgwODk3ODB9.DyVoiOX6h4pxB9gmxQlIMKKJzm1LZj4Nmmxlb018X5M';
decodeApproovJwtToken($validApproovJwtToken, $approovSecret);



function decodeApproovJwtToken($validApproovJwtToken, $approovSecret)
{
    try {
        //debug($validApproovJwtToken, 'validApproovJwtToken');
        //debug($approovSecret, 'approovSecret');

        $decoded = JWT::decode($validApproovJwtToken, $approovSecret, ['HS256']);
        debug($decoded, 'decoded');

    } catch(\UnexpectedValueException $exception) {

        echo "\n * Unexpected Value Exception: {$exception->getMessage()}\n";

    } catch(\InvalidArgumentException $exception) {

        echo "\n * Invalid Argument Exception: {$exception->getMessage()}\n";

    } catch(\DomainException $exception) {

        echo "\n * Domain Exception: {$exception->getMessage()}\n";
    }
}

function debug($var, $varName)
{
    echo "\n\${$varName}: ";
    var_dump($var);
}


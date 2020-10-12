<?php
session_start();

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require './vendor/autoload.php';

// Enable Sandbox. For our project we are only using Sandbox
$enableSandbox = true;

// PayPal settings
$paypalConfig = [
    'client_id' => 'AXKGlTFpQwYHAH93bicFddw4COolNu4Yybo_ANmemZw1nb1pYyLOBhEQIJxsulsHim4ZQxJE97Q9k1hv',
    'client_secret' => 'ENKrkSlqQnohgLXb95ipZxRbgJQtPhwfpPhYq12oHoDKRyC0s0tMl6ru5mPkEbTJUMlOkL9THTZLL2N-',
    'return_url' => 'http://adisha.mtacloud.co.il/Includes/paypal/response.php',
    'cancel_url' => 'http://adisha.mtacloud.co.il/Includes/paypal/payment-cancelled.php'
];

// Database settings
$dbConfig = [
    'host' => 'localhost',
    'username' => 'adisha',
    'password' => 'Ff7AXqxIxF7b',
    'name' => 'adisha_shape4you_managment'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
 
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
        
    ]);

    return $apiContext;
}
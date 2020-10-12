<?php
session_start();

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

require 'paypal_bootstrap.php';

if (empty($_POST['item_number'])) {
    throw new Exception('This script should not be called directly, expected post data');
}

$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Setting up price and currency
$currency = 'ILS';
$amountPayable = 1200.00;
$invoiceNumber = uniqid();

$amount = new Amount();
$amount->setCurrency($currency)
    ->setTotal($amountPayable);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription('תשלום עבור מנוי שנתי')
    ->setInvoiceNumber($invoiceNumber);

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($paypalConfig['return_url'])
    ->setCancelUrl($paypalConfig['cancel_url']);

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions([$transaction])
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
} catch (Exception $e) {
    throw new Exception('Unable to create link for payment');
}

header('location:' . $payment->getApprovalLink());
exit(1);
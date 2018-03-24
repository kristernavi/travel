<?php

namespace App\PaypalPayment;

use PayPal\Api\Amount;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Sale;
use PayPal\Api\Transaction;

class PaypalRepository
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AdYF-eU6ZgTK76vhCkb1sDrJxkm5OyBZALrkrt3OkhqKzW1Lr0G5zYgVcvKNWNpdFIugXF0W2ah1lEee',     // ClientID
            'EPHF2McJ0T9rLzIgbEQ-Yzcbpws93_9cZO2fTygIwFJGxQtheiMOjfZq2016EUWN4nH6ylPyV7FecMB6'      // ClientSecret
        )
    );
        $this->apiContext->setConfig(['http.CURLOPT_SSLVERSION' => CURL_SSLVERSION_TLSv1]);
    }

    public function getApiContext()
    {
        return $this->apiContext;
    }

    public function createPayment($items, $total, $success, $cancel)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $itemList = new ItemList();
        $itemList->setItems($items);
        $amount = new Amount();
        $amount->setCurrency('PHP')
        ->setTotal($total);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription('Checkout from Bohol Travel And Tours')
        ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($success)
        ->setCancelUrl(url($cancel));

        $payment = new Payment();
        $payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

        try {
            $payment->create($this->apiContext);

            return $payment->getApprovalLink();
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function excute($request)
    {
        try {
            $paymentExecute = new PaymentExecution();
            $payment = Payment::get($request->input('paymentId'), $this->apiContext);
            $execution = $paymentExecute->setPayerId($request->input('PayerID'));
            $trans = $payment->execute($execution, $this->apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }
}

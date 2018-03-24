<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;
use PayPal\Api\Transaction;

class PaypalController extends Controller
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

    public function index()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item1 = new Item();
        $item1->setName('henana')
        ->setCurrency('PHP')
        ->setQuantity(1)
        ->setSku('123123')
         ->setPrice(500);

        $itemList = new ItemList();
        $itemList->setItems([$item1]);
        $amount = new Amount();
        $amount->setCurrency('PHP')
        ->setTotal(500);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription('Payment description')
        ->setInvoiceNumber(uniqid());
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('/excute'))
        ->setCancelUrl(url('/cancel'));
        $payment = new Payment();
        $payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);
        $request = clone $payment;

        try {
            $payment->create($this->apiContext);

            return redirect($payment->getApprovalLink());
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function show()
    {
        $sale = Sale::get('PAY-82K43936HX055044VLK2JMOA', $this->apiContext);
        dd($sale);
    }

    public function excute(Request $request)
    {
        $paymentExecute = new PaymentExecution();
        $payment = Payment::get($request->input('paymentId'), $this->apiContext);
        $execution = $paymentExecute->setPayerId($request->input('PayerID'));
        $trans = $payment->execute($execution, $this->apiContext);

        echo 'Done';
    }

    public function refund()
    {
        $payments = Payment::get('PAY-0G277464GR574122MLK2RFZQ', $this->apiContext);
        $obj = $payments->toJSON();
        $paypal_obj = json_decode($obj);
        $transaction_id = $paypal_obj->transactions[0]->related_resources[0]->sale->id;

        $amt = new Amount();
        $amt->setCurrency('PHP')
        ->setTotal(20);
        $refundRequest = new RefundRequest();
        $refundRequest->setAmount($amt);
        $sale = new Sale();
        $sale->setId($transaction_id);
        $refundedSale = $sale->refundSale($refundRequest, $this->apiContext);

        return
    }
}

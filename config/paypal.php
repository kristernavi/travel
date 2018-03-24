<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode' => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username' => 'bisu.travel_api1.gmail.com',
        'password' => 'PMLNZFYWE9284CDA',
        'secret' => 'AoAC3ofyfNl18tZShc.UtcsvhlAKA4UEDxCtLJg939rA8XtzSmVGkFK4',
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id' => 'APP-80W284485P519543T', // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username' => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password' => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret' => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id' => '', // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency' => 'USD',
    'notify_url' => '', // Change this accordingly for your application.
    'locale' => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl' => true, // Validate SSL when creating api client.
];

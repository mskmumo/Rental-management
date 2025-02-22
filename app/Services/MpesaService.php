<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MpesaService
{
    protected $baseUrl;
    protected $consumerKey;
    protected $consumerSecret;
    protected $passkey;
    protected $shortcode;
    protected $env;

    public function __construct()
    {
        $this->env = config('mpesa.env');
        $this->baseUrl = $this->env === 'sandbox' 
            ? 'https://sandbox.safaricom.co.ke' 
            : 'https://api.safaricom.co.ke';
        $this->consumerKey = config('mpesa.consumer_key');
        $this->consumerSecret = config('mpesa.consumer_secret');
        $this->passkey = config('mpesa.passkey');
        $this->shortcode = config('mpesa.shortcode');
    }

    public function getAccessToken()
    {
        $credentials = base64_encode($this->consumerKey . ':' . $this->consumerSecret);

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials
        ])->get($this->baseUrl . '/oauth/v1/generate?grant_type=client_credentials');

        $result = json_decode($response->body());
        return $result->access_token;
    }

    public function initiateSTKPush($phoneNumber, $amount, $reference)
    {
        $accessToken = $this->getAccessToken();
        $timestamp = Carbon::now()->format('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken
        ])->post($this->baseUrl . '/mpesa/stkpush/v1/processrequest', [
            'BusinessShortCode' => $this->shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phoneNumber,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => config('mpesa.callback_url'),
            'AccountReference' => $reference,
            'TransactionDesc' => 'Room Booking Payment'
        ]);

        return json_decode($response->body());
    }

    public function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        if (strlen($phoneNumber) === 9) {
            $phoneNumber = '254' . $phoneNumber;
        } elseif (strlen($phoneNumber) === 10 && $phoneNumber[0] === '0') {
            $phoneNumber = '254' . substr($phoneNumber, 1);
        } elseif (strlen($phoneNumber) === 12 && substr($phoneNumber, 0, 3) === '254') {
            return $phoneNumber;
        }
        
        return $phoneNumber;
    }
} 
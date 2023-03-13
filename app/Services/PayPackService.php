<?php

namespace App\Services;

use App\Models\HiqMomo;
use Illuminate\Support\Facades\DB;
use Auth;
use Paypack\Paypack;


class PayPackService

{


    public $payment_key;
    public $phone_number;
    public $payment_amount;


    public function __construct(  $payment_key, $phone_number, $payment_amount ){


        $this->payment_key =  $payment_key;
        $this->phone_number =  $phone_number;
        $this->payment_amount =  $payment_amount;
    }



    //Check System Status
    public function status(){
        $paypackInstance = new  Paypack();
        $paypackInstance->config([ 'client_id' => env('PAYPACK_CLIENT_ID'), 'client_secret' => env('PAYPACK_CLIENT_SECRET'), ]);
        $profile = $paypackInstance->me();

        if($profile['id'] != null){
            return true;
        }else{
            return false;
        }

    }


    //Send  Payment Details
    public function pay(){
        $paypackInstance = new  Paypack();
        $paypackInstance->config([ 'client_id' => env('PAYPACK_CLIENT_ID'), 'client_secret' => env('PAYPACK_CLIENT_SECRET'), ]);
        $cashin = $paypackInstance->Cashin(['phone' => $this->phone_number,  'amount' => $this->payment_amount,]);
        $store = new HiqMomo;
        $store->user_id = '0';
        $store->user_email   =  'site@example.com';
        $store->phone_number   =  $this->phone_number;
        $store->payment_geteway   =  'PayPack';
        $store->payment_amount   =  $this->payment_amount;
        $store->payment_status   =  'pending';
        $store->payment_ref   = $cashin['ref'];
        $store->payment_archive   =  0;
        $store->payment_key   =$this->payment_key  ;
        $store->save();

    }

}

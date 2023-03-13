<?php

namespace App\SuperAdmin\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiBaseController;
use App\SuperAdmin\Http\Requests\Api\Admin\SubmitOfflinePaymentRequest;
use App\SuperAdmin\Http\Requests\Api\OfflineRequest\IndexRequest;
use App\SuperAdmin\Models\PaymentTranscation;
use Examyou\RestAPI\ApiResponse;

//Added
use Illuminate\Support\Facades\DB;
use App\Services\PayPackService;
use Illuminate\Support\Str;

class AdminOfflineRequestController extends ApiBaseController
{
    protected $model = PaymentTranscation::class;

    protected $indexRequest = IndexRequest::class;

    public function modifyIndex($query)
    {
        $query = $query->offlineRequests();

        return $query;
    }

    public function submitOfflineRequest(SubmitOfflinePaymentRequest $request)
    {
        $loggedUser = user();
        $loggedUserCompany = company();

        $subscriptionPlanId = $this->getIdFromHash($request->subscription_plan_id);
        $offlinePaymentId = $this->getIdFromHash($request->offline_payment_mode_id);


        $payment_key = Str::random(32);
        $phone_number = $request->phone_number;
        $payment_amount = 100;
        $payment_gateway = 'PayPack';
        $send_pay_details = new PayPackService($payment_key, $phone_number, $payment_amount);
        $send_pay_request = $send_pay_details->pay();


        $insert = DB::table('payment_transcations')->insert([
            'payment_method' =>  "offline",
            'company_id' => $loggedUserCompany->id,
            'subscription_plan_id' => $subscriptionPlanId,
            'plan_type' => $request->plan_type,
            'status' => 'pending',
            'proof_document' => $request->proof_document,
            'submit_description' =>  $payment_key,
            'submitted_by_id' =>  $loggedUser->id,
            'offline_payment_mode_id' => 1,
            'is_offline_request' => 1,
        ]);

        return ApiResponse::make('Success', []);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\EmailService;
use App\Services\WhatsappService;

use App\Http\Controllers\Controller;
use App\Services\UnformalWhatsappService;

class OtpController extends Controller
{

    public function sendOtp(Request $request, $id)
    {
        $token = trim($request->header('Authorization'), "Bearer ");
        $subscription = Subscription::where('token', $token)->where('app_id', $id)->first();
        if (Carbon::now()->between(Carbon::parse($subscription->start_date), Carbon::parse($subscription->end_date)) && $subscription->number_of_messages_sent <= $subscription->number_of_messages) {
            $randomNumbers = [];
            for ($i = 0; $i < $subscription->number_of_digits; $i++) {
                $randomNumbers[] = rand(0, 10);
            }
            $formattedNumbers = array_map(function ($number) {
                return number_format($number, 0, '', '');
            }, $randomNumbers);
            $otp = implode('', $formattedNumbers);
            $data['otp'] = $otp;
            $data['name'] = $subscription->app_name;
            switch ($subscription->type) {
                case 'email':
                    $data['email'] = $request->contact;
                    $app = new EmailService();
                    $app->send($data);
                    $done = 1;
                    break;
                case 'whatsapp':
                    $data['phone'] = $request->contact;
                    $app = new WhatsappService();
                    $app->send($data);
                    $done = 1;
                    break;
                case 'unformal_whatsapp':
                    $data['phone'] = $request->contact;
                    $data['instance_id'] = $subscription->unformal_whatsapp_instance_id;
                    $data['token'] = $subscription->unformal_whatsapp_token;
                    $app = new UnformalWhatsappService();
                    $app->send($data);
                    $done = 1;
                    break;
                default:
                    $done = 0;
            }
            if ($done == 1) {
                Otp::create(['otp' => $otp,'contact'=>$request->contact, 'expires_at' => Carbon::now()->addMinutes($subscription->number_of_minutes), 'subscription_id' => $subscription->id]);
                $subscription->update(['number_of_messages_sent' => $subscription->number_of_messages_sent + 1]);
                return response()->json(['status' => 200, 'message' => 'Otp sent successfully, please check your OTP in ' . $subscription->number_of_minutes . ' minutes'], 200);
            }
        }
    }

    public function checkOTP(Request $request, $id)
    {
        $token = trim($request->header('Authorization'), "Bearer ");
        $subscription = Subscription::where('token', $token)->where('app_id', $id)->first();
        if (Carbon::now()->between(Carbon::parse($subscription->start_date), Carbon::parse($subscription->end_date))) {

            $otp = Otp::where(['otp' => $request->otp, 'is_used' => 0, 'subscription_id' => $subscription->id])->where('expires_at', '>=', Carbon::now())->first();

            if ($otp) {
                $otp->update(['is_used' => 1]);
                return response()->json(['status' => 200, 'message' => 'Otp verified successfully'], 200);
            }

            return response()->json(['status' => 400, 'message' => 'Invalid Otp'], 400);
        }
        return response()->json(['status' => 400, 'message' => 'Something went wrong'], 400);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class NotificationSendController extends Controller
{   
    public function index()
    {
        return view('fcm');
    }
    public function updateDeviceToken(Request $request)
    {
        Auth::user()->fcm_token =  $request->token;

        Auth::user()->save();

        return response()->json(['Token successfully stored.']);
    }

    public function sendNotification(Request $request)
    {
        $tokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();

        if (empty($tokens)) {
            return response()->json(['error' => 'No tokens found'], 400);
        }

        $data = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ],
        ];

        $headers = [
            'Authorization: ',
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // ✅ Best solution (auto-detect system certificates)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Keep SSL verification ON

        // ❌ Only for testing (disable SSL check)
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            return response()->json([
                'error' => 'CURL failed',
                'message' => $error,
            ], 500);
        }

        return response()->json([
            'response' => json_decode($response),
            'http_code' => $httpcode,
        ]);
    }
}
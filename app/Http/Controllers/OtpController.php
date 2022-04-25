<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    public function Otp(Request $request)
    {
        $OtpNumber = random_int(100000,999999);

        $data = Otp::Create([
            'otp' => $OtpNumber,
        ]);

        return view('reset');

    }
    
}

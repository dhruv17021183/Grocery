<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OtpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function otp(Request $request)
    {

        $OtpNumber = random_int(100000,999999);
        $MobileNumber = DB::table('users')->select('MobileNumber')->where('id',$request->user()->id)->get();
        $Number = $MobileNumber[0]->MobileNumber;

        $data = Otp::Create([
            'otp' => $OtpNumber,
            'MobileNo' => $Number,
        ]);

        return view('reset');
    }

    public function otpVerify(Request $request)
    {
        $request->validate([
            'otp' => 'required|min:6|max:6',
        ]);

        $reqOtp = (int)$request->otp;
    
        $MobileNumber = DB::table('users')->select('MobileNumber')->where('id',$request->user()->id)->get();
        $Number = $MobileNumber[0]->MobileNumber;

        $otp = DB::table('otps')->select('otp')->where('MobileNo',$Number)->get()->pluck('otp')->toArray();
        
        if($reqOtp === $otp[0])
        {
            DB::table('otps')->where('MobileNo',$Number)->delete();
            return redirect('home');
        }
        else
        {
            return redirect()->back();
        }
        
    }
    
}

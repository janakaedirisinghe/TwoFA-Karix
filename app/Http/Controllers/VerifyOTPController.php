<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class VerifyOTPController extends Controller
{
    public function verify(Request $request){

        if (request('OTP') == Cache::get('OTP')){

            auth()->user()->update(['isVerified ' => true]);
            return response(null,200);
        }

    }
}

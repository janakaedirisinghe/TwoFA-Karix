<?php

namespace App;

use App\Mail\OTPMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','isVerified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function OTP(){
        return Cache::get('OTP');
    }
    public function cacheTheOTP(){
        $OTP = rand(10000,999999);
        Cache::put(["OTP_for_{$this->id}" => $OTP],now()->addSecond(20));
        return $OTP;

    }

    public function sendOTP(){

        Mail::to('janakapradeepedirisinghe@gmail.com')->send(new OTPMail($this->cacheTheOTP()));

    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

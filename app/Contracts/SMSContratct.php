<?php
namespace App\Contracts;
interface SMSContratct {
    public function sendSMS($phone, $message);
}

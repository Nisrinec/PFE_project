<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail; 

class EmailTestController extends Controller
{
    public function sendTestEmail()
    {
        $to = 'nisrinechkah12@gmail.com'; 
        Mail::to($to)->send(new TestEmail());

        return 'Test email sent!';
    }
}
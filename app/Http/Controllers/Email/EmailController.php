<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function email()
    {
       $emails = DB::table('subscribers')
        ->select('subscribers.email')
        ->get();
        foreach($emails as $email) {
            $details['email'] = $email;
            dispatch(new SendEmailJob($details));
        }
    dd('done');
    }
}

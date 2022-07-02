<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\models\Book;

class EmailController extends Controller
{
    /**
     * Send Book Information to Subscribers
     * @param $id
     */
    public function email($id)
    {
        $book = Book::where('id', $id)->first();
        $book->status = 1;
        $book->save();
        $emails = DB::table('subscribers')
            ->select('subscribers.email')
            ->get();
        foreach ($emails as $email) {
            $details['email'] = $email;
            $details['id'] = $id;
            dispatch(new SendEmailJob($details));
        }
        dd("Email Sent Successfully");
    }
}

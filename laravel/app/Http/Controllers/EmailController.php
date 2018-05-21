<?php

namespace feeduciary\Http\Controllers;

use feeduciary\Advisor;
use feeduciary\Rate;
use feeduciary\Mail;
use feeduciary\Mail\ContactUs;
use feeduciary\Mail\Message;
use feeduciary\Mail\Welcome;
use feeduciary\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function contact () {
        return view ('casual.contact');
    }

    public function contactUs(Request $request)
    {
        // if Domain Name Validation turned off don't forget to check hostname field
        // if($resp->getHostName() === $_SERVER['SERVER_NAME']) {  }

        $company = env('MAIL_FROM_ADDRESS', 'message@feeduciary.com');
        $name    = $request->input('name');
        $email   = $request->input('email');
        $phone   = $request->input('phone');
        $message = $request->input('message');
        $subject = "Contact from Feeduciary.com " . $name;

        $data = array ( "title"        => "Customer Contact",
                        "name"         => $request->input('name'),
                        "fromEmail"    => $request->input('email'),
                        "phone"        => $request->input('phone'),
                        "content"      => $request->input('message'),
                        "server_name"  => env('APP_URL'),
                        "subject"      => $subject
                    );

        \Mail::to($company)->send(new ContactUs($data));
        return view('casual.thankYou', compact('data'));
    }


    public function contactAdvisor(Advisor $advisor) { 
        return view('advisors.contact', compact('advisor'));
    }

    public function send(Advisor $advisor, Request $request)
    {
        $company = env('MAIL_FROM_ADDRESS', 'message@feeduciary.com');
        $id      = $request->input('id');
        $name    = $request->input('name');
        $advisorName = $request->input('advisorName'); 
        $advisorEmail= $request->input('advisorEmail');
        $phone   = $request->input('phone');
        $message = $request->input('message');
        $subject = "Message from " . $name;

        $data = array ( "title"        => $request->input('title'),
//                        "id"           => $request->input('id'),
                        "id"           => $advisor->id,
                        "advisorName"  => $advisor->name,
                        "advisorEmail" => $advisor->email,
                        "name"         => $request->input('name'),
                        "guestEmail"   => $request->input('guestEmail'),
                        "phone"        => $request->input('phone'),
                        "content"      => $request->input('message'),
                        "server_name"  => env('APP_URL'),
                        "subject"      => $subject
                    );

        $result = \Mail::to($advisor->email, $advisor->name)->bcc($company)->send(new Message($data));
/*
        \Mail::send('emails.message', $data, function ($message) use ($advisorName, $toEmail, $subject, $name)
        {
            $message->from('message@feeduciary.com', "Feeduciary.com");
            $message->to($toEmail,$advisorName);
            $message->subject($subject);
        });
*/
//      return response()->json(['message' => 'Request completed']);
        $success = "Message Sent " . $result;
        $rates = Rate::where("id",$advisor->id)->get();
        return view('advisors.edit',compact('success', 'advisor', 'rates'));
    }
}

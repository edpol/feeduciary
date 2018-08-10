<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;
use feeduciary\Advisor;
use feeduciary\Rate;
use feeduciary\Http\Controllers\Controller;
use feeduciary\Mail;
use feeduciary\Mail\ContactUs;
use feeduciary\Mail\Message;
use feeduciary\Mail\Verification;
use feeduciary\Mail\Welcome;

class EmailController extends Controller
{
    public function contact () {
        return view ('casual.contact');
    }

    public function verification(Request $request) {
        $data = [
                'name'   => htmlentities(request('name')),
                'token'  => bin2hex(random_bytes(64)),
                'email'  => htmlentities(request('email')),
                'subject'=> 'Email verification',
                'server_name' => htmlentities(env('APP_URL')),
                'id' => 7,
                ];
        \Mail::to($data['email'],$data['name'])->send(new Verification($data));
        return view('email.thankYou', compact('data'));
    }

    public function contactUs(Request $request)
    {
        // if Domain Name Validation turned off don't forget to check hostname field
        // if($response->getHostName() === $_SERVER['SERVER_NAME']) {  }

        $company = env('MAIL_FROM_ADDRESS', 'message@feeduciary.com');
        $data = array ( "title"        => "Customer Contact",
                        "name"         => htmlentities($request->input('name')),
                        "fromEmail"    => htmlentities($request->input('email')),
                        "phone"        => htmlentities($request->input('phone')),
                        "content"      => htmlentities($request->input('message')),
                        "server_name"  => env('APP_URL'),
                        "subject"      => "Contact from Feeduciary.com " . $request->input('name')
                    );

        \Mail::to($company)->send(new ContactUs($data));
        return view('email.thankYou', compact('data'));
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
                        "subject"      => "Message from " . $request->input('name')
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
        return view('advisors.show',compact('success', 'advisor', 'rates'));
    }
}

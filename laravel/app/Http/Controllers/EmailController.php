<?php

namespace feeduciary\Http\Controllers;

use feeduciary\Advisor;
use feeduciary\Mail;
use feeduciary\Mail\Welcome;
use feeduciary\Mail\Message;
use feeduciary\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
	public function send(Request $request)
    {
        $id = $request->input('id');
        $advisorName = $request->input('id');
        $toEmail = $request->input('toEmail');
		$name = $request->input('name');
		$subject = "Message from " . $name;

        $data = array (	"title"      => $request->input('title'),
			       		"name"       => $request->input('name'),
			       		"advisorName"=> $request->input('advisorName'),
						"fromEmail"  => $request->input('fromEmail'),
        				"phone"      => $request->input('phone'),
						"content"    => $request->input('message'),
                        "subject"    => $subject 
					);

        \Mail::to($toEmail)->send(new Message($data));
/*
        \Mail::send('emails.send', $data, function ($message) use ($advisorName, $toEmail, $subject, $name)
        {
            $message->from('message@feeduciary.com', "Feeduciary.com");
            $message->to($toEmail,$advisorName);
            $message->subject($subject);
        });
*/
		$advisor = Advisor::where("id",$id)->first();
        return view('advisors.show', compact('advisor'));
//        return response()->json(['message' => 'Request completed']);
    }
}

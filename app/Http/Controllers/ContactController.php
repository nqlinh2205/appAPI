<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('admin.campaign.contactForm');
    }

    public  function send(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if($this->isOnline()){
            $mail_data = [
                'recipent' => $request->email,
                'fromEmail' => 'meowmeowshop225@gmail.com',
                'fromName' => $request->name,
                'subject' => $request->subject,
                'body' => $request->message,
            ];
            Mail::send('admin.campaign.email-template',$mail_data, function($message) use ($mail_data) {
                $message->to($mail_data['recipent'])
                        ->from($mail_data['fromEmail'],$mail_data['fromName'])
                        ->subject($mail_data['subject']);
            });
            return redirect()->back()->with('success','Email sent');
        }else{
            return redirect()->back()->withInput()->with('error','Check your connection');

        }

    }

    public function isOnline($site = 'https://www.youtube.com/'){
        if(@fopen($site, 'r')){
            return true;
        }else{
            return false;
        }
    }
}

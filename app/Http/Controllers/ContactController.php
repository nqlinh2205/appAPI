<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Detailcampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Codexshaper\WooCommerce\Facades\WooCommerce;

class ContactController extends Controller
{
    public function index($id){
        $campaign = Campaign::find($id);
        return view('admin.campaign.contactForm',compact('campaign'));
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

    public function sendEmailCampaign($idCampaign){
        $detail = Detailcampaign::where('campaign_id',$idCampaign)->first();
        $list_email = explode(',',$detail->list_email);
            if($this->isOnline()){
                foreach($list_email as $email){
                $mail_data = [
                    'recipent' => $email,
                    'fromEmail' => 'meowmeowshop225@gmail.com',
                    'fromName' => 'Meow Meow Petshop',
                    'subject' => $detail->subject,
                    'body' => $this->generateNameCustomer($detail->message,$email),
                ];
                Mail::send('admin.campaign.email-template',$mail_data, function($message) use ($mail_data) {
                    $message->to($mail_data['recipent'])
                            ->from($mail_data['fromEmail'],$mail_data['fromName'])
                            ->subject($mail_data['subject']);
                });
            }
                $campaign = Campaign::find($idCampaign);
                $campaign->active = 1;
                $campaign->save();
                return redirect()->back()->with('success','Email đã gửi');
            }else{
                return redirect()->back()->withInput()->with('error','Kiểm tra đường truyền');
    
            }
        
    }

    public function generateNameCustomer($mess = '',$email = ''){
        $orders = Woocommerce::all('orders',['per_page' =>100]);
        foreach($orders as $key => $order){
            if($order->billing->email == $email) {
                $mess = 'Kính gửi:'.$order->billing->last_name.' '.$order->billing->first_name.'<br>'.$mess;
                break;
            }
    }
    return $mess;
}
}

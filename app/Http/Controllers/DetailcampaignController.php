<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Detailcampaign;
use Codexshaper\WooCommerce\Facades\Order;
use Codexshaper\WooCommerce\Facades\WooCommerce;

class DetailcampaignController extends Controller
{
    public function index($id){
        $campaign = Campaign::find($id);
        $detail = Detailcampaign::where('campaign_id',$id)->first();
        return view('admin.campaign.contactForm',compact('campaign','detail'));
    }

    public function store(Request $request,$id){
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ],[
            'subject.required' => 'Tiêu đề chiến dịch không được để trống',
            'message.required' => 'Nội dung chiến dịch không được để trống'
        ]);
        if($request->email == 0){
            $listEmail = self::handleAllEmail();
        }elseif($request->email == 1){
            $listEmail = self::handleListEmail($request->list_email);
        }
        $detail =  new Detailcampaign;
        $detail->subject = $request->subject;
        $detail->message = $request->message;
        $detail->list_email = $listEmail;
        $detail->campaign_id = $id;
        $detail->email = $request->email;
        $detail->save();
        $campaign = Campaign::find($id);
        $campaign->status = 1;
        $campaign->save();
        return redirect()->to('/campaign/list');
    }

    public function handleAllEmail(){
        $orders = Woocommerce::all('orders',['per_page' =>100]);
        
        $listEmail = [];
        foreach($orders as  $order){
            if(in_array($order->billing->email,$listEmail)){
                continue;
            }
            $listEmail[] = $order->billing->email;
        }
        $listEmail = implode(',',$listEmail);
        return $listEmail;
    }
    public function handleListEmail($list =""){
        $list = str_replace(" ",'',$list);
        return $list;
    }

    public function update(Request $request, $id){
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ],[
            'subject.required' => 'Tiêu đề chiến dịch không được để trống',
            'message.required' => 'Nội dung chiến dịch không được để trống'
        ]);
        if($request->email == 0){
            $listEmail = self::handleAllEmail();
        }elseif($request->email == 1){
            $listEmail = self::handleListEmail($request->list_email);
        }
        $detail =  Detailcampaign::find($id);
        $detail->subject = $request->subject;
        $detail->message = $request->message;
        $detail->list_email = $listEmail;
        $detail->campaign_id = $id;
        $detail->email = $request->email;
        $detail->save();
        return redirect()->to('/campaign/list');
    }

    


}

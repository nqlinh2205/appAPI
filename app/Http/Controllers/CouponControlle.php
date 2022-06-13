<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Coupon;
use Codexshaper\WooCommerce\Facades\Order;
use Illuminate\Support\Facades\Mail;

class CouponControlle extends Controller
{
    public function createCoupon($id){
        $info = self::generateInfoCoupon($id);
        if($info != null){
            $data = [
                'code' => $info['code'],
                'discount_type' => 'percent',
                'amount' => '10',
                'individual_use' => true,
                'exclude_sale_items' => true,
                'minimum_amount' => '100000',
                'usage_count' => '1',
                'usage_limit_per_user' => '1'
            ];
            $coupon = Coupon::create($data);
            $this->sendCoupon($id,$info['code']);
        }
        return redirect()->to('/order/page/1');
    }

    public static function generateInfoCoupon($id){
        $order = Order::find($id);
        $info = [];
        if($order){
            $email = $order['billing']->email;
            $info['code'] = 'cp-'.explode('@',$email)[0].'-'.substr(md5(time()), 0, 4);
        }
        return $info;
    }

    public function sendCoupon($id,$name_coupon){
        $order = Order::find($id);
        $email = $order['billing']->email;
        $message = 'Cám ơn khách hàng đã mua hàng tại MeowMeowPetshop để tri ân khách hàng chúng tôi xin gửi bạn mã coupon cho lần mua hàng tới!
        <br>Mã của bạn là:'.$name_coupon;
        $request = new Request([
            'name' => 'Meow Meow Petshop',
            'email' => $email,
            'subject' => 'Tri ân khách mua hàng!',
            'message' => $message,
        ]);
        $this->send($request);
    }

    public  function send($request){

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

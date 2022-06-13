<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    
    public function index(){
        $campaigns = Campaign::get();
        return view('admin.campaign.list', compact('campaigns'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Nhập tên chiến dịch'
        ]);
        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->save();
        return redirect()->to('/campaign/list');
    }

    public function delete($id){
        $compaign = Campaign::find($id);
        $compaign->delete();
        return redirect()->to('/campaign/list');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignController extends Controller
{
    
    public function index(){
        return view('admin.campaign.app');
    }

    public function store(){}

    public function delete(){}
}

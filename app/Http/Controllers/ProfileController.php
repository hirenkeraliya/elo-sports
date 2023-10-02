<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Deposite;
use App\Models\Users;
use App\Models\Setting;
use App\Models\WalletTransaction;
use DB;
use Session;

class ProfileController extends Controller
{
    public function index($open_popup=0)
    {
        $profile = auth()->user();
        $setting=Setting::find(1);// get setting

        $id = $profile->id;
        $bets = Bet::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        $u_name = Users::where('Email', $profile->email)->get()->pluck('Username');
        $deposits = WalletTransaction::where('user_id', $id)->where('transaction_type', 'credit')->orderBy('created_at', 'desc')->limit(5)->get();
        $withdrawls = WalletTransaction::where('user_id', $id)->where('transaction_type', 'debit')->orderBy('created_at', 'desc')->limit(5)->get();
        //        $conversion = \DB::table('conversion')->first();

        return view('profile', compact('profile', 'bets', 'withdrawls', 'deposits', 'setting', 'open_popup'));

    }
}

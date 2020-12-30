<?php

namespace App\Http\Controllers;

use App\Events\MembershipUpdate;
use App\Events\StatusUpdatedGlobal;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MembershipStatusController extends Controller
{
    //

    public function suspend(Membership $membership) {
        $membership->setStatus('suspended');
        event(new MembershipUpdate());
        return $membership;

    }
    public function activate(Membership $membership) {
        
        $membership->setStatus('active');
        event(new MembershipUpdate());
        return $membership;


    }
    public function renew(Membership $membership) {

        $date = Carbon::createFromTimeString($membership->expired_at) ;
        // dd($date , now()->addHour()->addSecond() , $date > now()->addHour()->addSecond());
        $membership->expired_at = $date < now()->addHour()->addSecond() ? now()->addHour()->addDays($membership->package->cycle->period)->setTime(0,0,0) : $date->addDays($membership->package->cycle->period)->setTime(0,0,0);
        $membership->setStatus('active');
        $membership->save();
        event(new MembershipUpdate());
        return $membership;

    }
    
}

<?php

namespace App\Http\Controllers;

use App\Events\StatusUpdatedGlobal;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MembershipStatusController extends Controller
{
    //

    public function suspend(Membership $membership) {
        event(new StatusUpdatedGlobal());
        return $membership->setStatus('suspended');
    }
    public function activate(Membership $membership) {
        return $membership->setStatus('active');
    }
    public function renew(Membership $membership) {
        $date = Carbon::createFromTimeString($membership->expired_at) ;
        dd($membership->package->cycle->period);
        $membership->expired_at = $date->addDays($membership->package->cycle->period);
        return $membership->setStatus('active');
    }
}

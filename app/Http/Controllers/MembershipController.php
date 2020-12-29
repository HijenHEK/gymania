<?php

namespace App\Http\Controllers;

use App\Events\MembershipUpdate;
use App\Events\MemberUpdate;
use App\Models\Member;
use App\Models\Membership;
use DateTime;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Member $member )
    {
        if($member->id){
            
            return $member->memberships()->with(['package' , 'statuses' , 'package.cycle' , 'package.activity'])->orderBy('expired_at' , 'ASC')->get();
        }
        
        if(Request('exp')) {
            $exp = Request('exp');
            return Request('all') ? Membership::with(['member' , 'statuses' , 'package' ,'package.cycle' , 'package.activity'])->where('expired_at' , '<' ,  now()->addDays($exp))->orderBy('expired_at' , 'ASC')->get()  : Membership::with(['member' , 'statuses' , 'package' , 'package.cycle' , 'package.activity'])->where('expired_at' , '>' ,  now()->addDays(-3))->orderBy('expired_at' , 'ASC')->paginate(10);
        }

        return Request('all') ? Membership::with(['member' , 'statuses' , 'package' ,'package.cycle' , 'package.activity'])->orderBy('expired_at' , 'ASC')->get()  : Membership::with(['member' , 'statuses' , 'package' , 'package.cycle' , 'package.activity'])->orderBy('expired_at' , 'ASC')->paginate(10);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Member $member , Request $request)
    {
        $member->addPackages($request->all()) ;
        event(new MembershipUpdate());
        return $member ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\MembershipUpdate;
use App\Events\PackageUpdate;
use App\Models\Activity;
use App\Models\Cycle;
use App\Models\Membership;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Request('q'))
        {
            $key = Request('q');
            return Package::latest()->where('name' , 'LIKE' , "%{$key}%")
            ->orWhere('fee' , 'LIKE' , "%{$key}%")
            ->orWhere('id' , 'LIKE' , "%{$key}%")
            ->with(['activity' , 'cycle'])->paginate(10);
    
        }
        return Request('all')  ? Package::with(['activity' , 'cycle' , 'memberships' ,'memberships.statuses'])->get() : Package::with(['activity' , 'cycle', 'memberships' ,'memberships.statuses'])->paginate(10);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'fee' => 'required|regex:/^[0-9]+(?:\.[0-9]+)?$/',
            'cycle' => 'required|exists:cycles,id',
            'activity' => 'required|exists:activities,id',
        ]);
        $package = Package::create([
            'name' => Request('name'),
            'fee' => Request('fee'),
            'cycle_id' =>  Request('cycle'),
            'activity_id' =>  Request('activity'),
        ]);
        // $package->activity()->associate(Activity::findOrFail(Request('activity')));
        // $package->cycle()->associate(Cycle::findOrFail(Request('cycle')));
        event(new PackageUpdate());
        
        return $package ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|max:255',
            'fee' => 'required|regex:/^[0-9]+(?:\.[0-9]+)?$/',
            'cycle' => 'required|exists:cycles,id',
            'activity' => 'required|exists:activities,id',
        ]);
        $package->update([
            'name' => Request('name'),
            'fee' => Request('fee'),
            'cycle_id' =>  Request('cycle'),
            'activity_id' =>  Request('activity'),
        ]);
        // $package->activity()->associate(Activity::findOrFail(Request('activity')));
        // $package->cycle()->associate(Cycle::findOrFail(Request('cycle')));
        event(new PackageUpdate());
        return $package ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}

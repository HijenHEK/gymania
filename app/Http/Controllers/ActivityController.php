<?php

namespace App\Http\Controllers;

use App\Events\ActivityUpdate;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;

class ActivityController extends Controller
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
            return Activity::latest()->where('name' , 'LIKE' , "%{$key}%")
            ->orWhere('id' , 'LIKE' , "%{$key}%")
            ->orWhere('desc' , 'LIKE' , "%{$key}%")
            ->paginate(3);
    
        }
        return Request('all')  ? Activity::latest()->get() : Activity::latest()->paginate(3);

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
            'name' => 'required|min:2|max:50',
            'desc' => 'min:2|max:255',
            
        ]);
        event(new ActivityUpdate());

        return Activity::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'desc' => 'min:2|max:255',
            
        ]);
        event(new ActivityUpdate());

        return $activity->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}

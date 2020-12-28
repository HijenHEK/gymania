<?php

namespace App\Http\Controllers;

use App\Events\CycleUpdate;
use App\Models\Cycle;
use Illuminate\Http\Request;

class CycleController extends Controller
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
            return Cycle::latest()->where('name' , 'LIKE' , "%{$key}%")
            ->orWhere('period' , 'LIKE' , "%{$key}%")
            ->orWhere('id' , 'LIKE' , "%{$key}%")
            ->orWhere('desc' , 'LIKE' , "%{$key}%")
            ->paginate(10);
    
        }
        return Request('all')  ? Cycle::latest()->get() : Cycle::latest()->paginate(10);

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
            'period' => 'required|Integer'
            
        ]);

        event(new CycleUpdate());

        return Cycle::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function show(Cycle $cycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cycle $cycle)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'desc' => 'min:2|max:255',
            'period' => 'required|Integer'
            
        ]);
        event(new CycleUpdate());

        return $cycle->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cycle  $cycle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cycle $cycle)
    {
        //
    }
}

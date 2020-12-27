<?php

namespace App\Http\Controllers;

use App\Events\MemberUpdate;
use App\Models\Member;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    //

    public function index(){
        if(Request('q'))
        {
            $key = Request('q');
            

                return Member::latest()->where('name' , 'LIKE' , "%{$key}%")
                ->orWhere('email' , 'LIKE' , "%{$key}%")
                ->orwhere('id' , 'LIKE' , "%{$key}%")
                ->orWhere('phone' , 'LIKE' , "%{$key}%")
                ->orWhere('address' , 'LIKE' , "%{$key}%")
                ->with('memberships' )->paginate(10);
            
    
        }
        return Request('all')  ? Member::latest()->with('memberships' )->get() : Member::latest()->with('memberships' )->paginate(10) ;
    }
    public function show(Member $member){
        return $member;
    }
    
    public function store(){
        Request()->validate([
                'name' => 'required|max:255',
                'username' => 'max:255|unique:members,username',
                'email' => 'email|max:255|unique:members,email',
                'phone' => 'integer|max:99999999|min:00000000',
                'age' => 'required|max:2|min:1',
                'gender' => 'required',
                'address' => 'max:400',
        ]);
        
        $m = Member::create(Request()->all());
        if(Request()->hasFile('avatar')) {
            $av = Request()->file('avatar')->store('avatars/'.$m->username , ['disk'=>'public']);
            $m->avatar = $av;
        $m->save();
        }
        event(new MemberUpdate());

        return $m ;
    }

    public function update(Member $member){




        Request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:members,username,'.$member->id,
            'email' => 'required|email|max:255|unique:members,email,'.$member->id,
            'phone' => 'integer|max:99999999|min:00000000',
            'age' => 'required|max:2|min:1',
            'gender' => 'required',
            'address' => 'max:400',

    ]);

        $member->update(Request()->all());
        if(Request()->hasFile('avatar')) {
            $av = Request()->file('avatar')->store('avatars/'.$member->username , ['disk'=>'public']);
            $member->avatar = $av;
            $member->save();
        }
        event(new MemberUpdate());

        return $member ;
    }
}

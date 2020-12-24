<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Role;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index(){
        return Member::latest()->with('memberships' )->get();
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
        
        return $member ;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Role;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index(){
        return Member::latest()->with('memberships')->get();
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
        return Member::create(Request()->all());
    }
}

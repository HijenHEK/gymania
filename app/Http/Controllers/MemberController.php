<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Role;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index(){
        return Member::orderBy('created_at' , 'ASC')->get() ;
    }
}

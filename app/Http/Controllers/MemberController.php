<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function index(){
        return Role::where('name' , 'Member')->first()->users()->get() ;
    }
}

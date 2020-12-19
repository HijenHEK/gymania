<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //

    public function index(){
        return Role::where('name' , 'Client')->first()->users()->get() ;
    }
}

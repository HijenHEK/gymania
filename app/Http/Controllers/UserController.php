<?php

namespace App\Http\Controllers;

use App\Events\UserUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Request('all') ? User::latest()->with('role')->get() : User::latest()->with('role')->paginate(10);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request()->validate([
            'name' => 'required|max:255' ,
            'username' => 'required|max:255,unique:users,username' ,
            'email' => 'email|required|max:255,unique:users,email' ,
            'password' => 'required|max:255|min:8' ,
            'role_id' => 'exists:roles,id' ,
        ]);
        $u = User::create([
            'name' => Request('name'),
            'username' => Request('username'),
            'email' => Request('email'),
            'password' => Hash::make( Request('password') ),
        ]);
        $u->assignRole(Request('role_id'));
        if(Request()->hasFile('avatar')) {
            $av = Request()->file('avatar')->store('avatars/'.$u->username , ['disk'=>'public']);
            $u->avatar = $av;
            
        }
        
        $u->save();
        event(new UserUpdate());

        return $u ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Request('password')) {
            Request()->validate([
                'name' => 'required|max:255' ,
                'username' => 'required|max:255,unique:users,username,except,'.$user->id ,
                'email' => 'email|required|max:255,unique:users,email,except,'.$user->id ,
                'password' => 'required|max:255|min:8' ,
                'role_id' => 'exists:roles,id' ,
            ]);
            $user->update([
                'password' => Hash::make( Request('password') ),

            ]);
        }else {

            Request()->validate([
                'name' => 'required|max:255' ,
                'username' => 'required|max:255,unique:users,username,except,'.$user->id ,
                'email' => 'email|required|max:255,unique:users,email,except,'.$user->id ,
                'role_id' => 'exists:roles,id' ,
            ]);
        }
        $user->update([
            'name' => Request('name'),
            'username' => Request('username'),
            'email' => Request('email'),
        ]);
        $user->assignRole(Request('role_id'));

        if(Request()->hasFile('avatar')) {
            $av = Request()->file('avatar')->store('avatars/'.$user->username , ['disk'=>'public']);
            $user->avatar = $av;
        }
        $user->save();

        event(new UserUpdate());

        return $user ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

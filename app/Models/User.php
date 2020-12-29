<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class) ;
    }

    public function assignRole($role){
        if(is_integer($role)) {
            $role = Role::findOrFail($role);
            
        }else if(is_string($role)) {
            $role = Role::where('name' , $role)->orWhere('id' , $role)->first();
        } 
        if(!$role) {
            return false ;
        }
        $this->role()->associate($role);
        $this->save();
        return $this ;
    }
    
    public function ableTo($role) {
        if(is_integer($role)) {
            $role = Role::findOrFail($role);
            
        }else if(is_string($role)) {
            $role = Role::where('name' , $role)->first();
        } 
        if(!$role) {
            return false ;
        }
        return $this->role()->is($role);

    }

    public function getRouteKey()
    {
        return 'username' ;
    }
}

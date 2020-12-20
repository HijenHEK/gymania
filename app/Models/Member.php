<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function memberships() {
        return $this->hasMany(Membership::class);
    }

    public function addPackages($data){
        
      
        foreach($data as $package){
            $this->memberships()->create(['package_id' => $package['id']]);
        }
        
    }

}

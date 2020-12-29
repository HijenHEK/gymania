<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Package extends Model
{
    use HasFactory , HasStatuses;

    protected $guarded = [];
    public function activity() {
        return $this->belongsTo(Activity::class);
    }
    public function cycle() {
        return $this->belongsTo(Cycle::class);
    }
    public function memberships() {
        return $this->hasMany(Membership::class);
    }
    public function activeMemberships() {
        $active = [] ;
        foreach ($this->memberships()  as $m) {
            if ($m->status == "active") {
                array_push($active,$m);
            }
        }
        $active = new Collection($active);
        return $active ;
        
    }

}

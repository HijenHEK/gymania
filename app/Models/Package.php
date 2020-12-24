<?php

namespace App\Models;

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


}

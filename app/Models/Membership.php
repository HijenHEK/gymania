<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Membership extends Model
{
    use HasFactory , HasStatuses;
    protected $guarded = [];
    public function package() {
        return $this->belongsTo(Package::class);
    }
    public function member() {
        return $this->belongsTo(Member::class);
    }
    

    
}

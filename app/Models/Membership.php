<?php

namespace App\Models;

use Carbon\Carbon;
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
    

    public function expand($n) {
        $this->expired_at = Carbon::createFromTimeString($this->expired_at)->addDays($n)->setTime(0, 0, 0);
        $this->save();
    }
}

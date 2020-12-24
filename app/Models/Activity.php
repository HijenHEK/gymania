<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Activity extends Model
{
    use HasFactory , HasStatuses;
    protected $fillable=['name' , 'desc'];
        
    public function packages() {
        return $this->hasMany(Package::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    protected $fillable=['name' , 'desc' , 'period'];
    public function packages() {
        return $this->hasMany(Package::class);
    }
}

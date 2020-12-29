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
    public function memberships() {
        return $this->hasManyThrough(Membership::class , Package::class);
        // return $this->packages->map->memberships->collapse();
    }
    public function membershipsStatusCount() {
        return $this->packages->map->memberships->collapse()->map->status->countBy() ;
        // return $this->packages->map->memberships->collapse()->map->status()->where('name','suspended')->count ;
    }
    // public function me
    
    
}

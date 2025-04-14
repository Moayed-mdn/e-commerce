<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN=1;
    
    public function staff(){
        return $this->hasMany(Staff::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationMethod extends Model
{
    /** @use HasFactory<\Database\Factories\CommunicationMethodFactory> */
    use HasFactory;

    protected $fillable=[
        'name'
    ];

    public function suppliers(){
        return $this->BelongsToMany(Supplier::class);
    }

}

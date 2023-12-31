<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function asset(){
        return $this->belongsTo(Asset::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
}

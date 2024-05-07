<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(Type::class,'type_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'agent_id','id');
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function rolesBTM()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    public function usersBTM()
    {
        return $this->belongsToMany('App\Models\User');
    }
}

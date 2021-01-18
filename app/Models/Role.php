<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function permissionsBTM()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
    public function usersBTM()
    {
        return $this->belongsToMany('App\Models\User');
    }
}

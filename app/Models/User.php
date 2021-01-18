<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function UserHasRole($role_p){
        foreach($this->rolesBTM as $role_i){
            if(Str::lower($role_i->name) == Str::lower($role_p)){
                return true;
            }
        }
        return false;
    }


    // +-------------------------------------+
    // |             Relationships           |
    // +-------------------------------------+
    public function postHM()
    {
        return $this->hasMany('App\Models\Post');
    }


    public function permissionsBTM()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
    public function rolesBTM()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    public function commentsHM()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function repliesHM()
    {
        return $this->hasMany('App\Models\Reply');
    }
    public function votesHM()
    {
        return $this->hasMany('App\Models\Vote');
    }


    // Accessor
    public function getCoverPhotoAttribute($x){
        return asset("storage/".$x);
    }
    public function getProfilePicAttribute($x){
        return asset("storage/".$x);
    }
}

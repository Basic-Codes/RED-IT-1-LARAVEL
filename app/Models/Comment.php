<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function usersBT()
    {
        return $this->belongsTo('App\Models\User', "user_id");
    }
    public function postsBT()
    {
        return $this->belongsTo('App\Models\Post', "post_id");
    }

    public function repliesHM()
    {
        return $this->hasMany('App\Models\Reply');
    }



    public function GetCommentReplies() {
        return $this->repliesHM();
    }
}

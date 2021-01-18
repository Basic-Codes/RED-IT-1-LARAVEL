<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'title',
    //     'post_image',
    //     'content',
    // ];
    
    // OR
    
    protected $guarded = [];


    public function userBT()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function commentsHM()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function votesHM()
    {
        return $this->hasMany('App\Models\Vote');
    }


    public function GetPostComments() {
        return $this->commentsHM();
    }
    // +-------------------------------------+
    // |                 Votes               |
    // +-------------------------------------+
    public function GetPostVotesCount() {
        return (count($this->votesHM()->where("vote_type", "up")->get()) - count($this->votesHM()->where("vote_type", "down")->get()));
    }
    public function UserAlreadyVoted() {

        $vote = $this->votesHM()->where("user_id", Auth::user()->id)->first();
        
        if($vote != null) {
            return $vote->vote_type;
        }else {
            return false;
        }
    }

    // Accessor
    public function getPostImageAttribute($x){
        return asset("storage/".$x);
    }
}

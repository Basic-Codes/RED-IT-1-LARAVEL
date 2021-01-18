<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentCtrl extends Controller
{
    public function store(Request $req, Post $post){
        Comment::create([
            'comment_content' => $req->comment_content,
            'user_id' => Auth::user()->id,
            'post_id' => $post->id
        ]);

        return back();
    }
    public function reply_store(Request $req, Comment $comment){
        Reply::create([
            'reply_content' => $req->reply_content,
            'user_id' => Auth::user()->id,
            'comment_id' => $comment->id
        ]);

        return back();
    }
    public function upvote(Post $post){
        
        if($post->UserAlreadyVoted() == false){
            Vote::create([
                'vote_type' => 'up',
                'user_id' => Auth::user()->id,
                'post_id' => $post->id
            ]);
        }
        else if($post->UserAlreadyVoted() == "up"){
            $vote = $post->votesHM()->where("user_id", Auth::user()->id)->first();
            $vote->delete();
        }
        else {
            $vote = $post->votesHM()->where("user_id", Auth::user()->id)->first();

            $vote->vote_type = "up";
            $vote->save();
        }

        return back();
    }
    public function downvote(Post $post){

        if($post->UserAlreadyVoted() == false){
            Vote::create([
                'vote_type' => 'down',
                'user_id' => Auth::user()->id,
                'post_id' => $post->id
            ]);
        }
        else if($post->UserAlreadyVoted() == "down"){
            $vote = $post->votesHM()->where("user_id", Auth::user()->id)->first();
            $vote->delete();
        }
        else {
            $vote = $post->votesHM()->where("user_id", Auth::user()->id)->first();

            $vote->vote_type = "down";
            $vote->save();
        }

        return back();
    }
}

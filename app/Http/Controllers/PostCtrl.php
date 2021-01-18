<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCtrl extends Controller
{
    public function index(){
        $all_posts = Post::all();

        return view('admin.post.index')->with(['posts'=>$all_posts]);
    }
    public function show(Post $post){
        return view('admin.post.post-show')->with(['post'=>$post]);
    }
    public function create(){
        return view('admin.post.create');
    }
    public function store(Request $req){
        $req->validate([
            'title' => 'required|max:255',
            'post_image'=>'file'
        ]);

        $input = $req->all();

        $input['user_id'] = Auth::user()->id;

        if($req->post_image){
            $input['post_image'] = $req->post_image->store('image');
        }

        Post::create($input);

        $req->session()->flash('msg', 'Post Created Succesfully');

        return redirect(route('home'));
    }
    public function destroy(Request $req, Post $post){
        $this->authorize('view', $post);

        $post->delete();

        $req->session()->flash('deleted-msg', 'Post Deleted Succesfully');

        return redirect(route('home'));
    }
    public function edit(Post $post){
        $this->authorize('view', $post);

        return view('admin.post.edit')->with(['post'=>$post]);
    }
    public function update(Request $req, Post $post){
        $this->authorize('view', $post);

        $req->validate([
            'title' => 'required|max:255',
            'post_image'=>'file'
        ]);

        $input = $req->all();

        if($req->post_image){
            $input['post_image'] = $req->post_image->store('post_image');
            $post->post_image = $input['post_image'];
        }

        $post->title = $input['title'];
        $post->content = $input['content'];

        User::find(Auth::user()->id)->postHM()->save($post);
        
        $req->session()->flash('msg', 'Post Updated Succesfully');

        return redirect(route('post.show', $post->id));
    }
}

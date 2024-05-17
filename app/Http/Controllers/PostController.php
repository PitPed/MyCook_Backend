<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Vote;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Str;

class PostController extends Controller
{
    function getAllPosts(Request $request){
        if(Post::count()<1) return response()->json(["message" => 'There are no posts'], 400);
        $posts = Post::with('user', 'images', 'comments','comments.user')->orderByDesc('post_id')->get();
        foreach($posts as $post){
            $post->votes = $post->votesNumber();
            $voted = Vote::where(['user_id'=> Session::has('user')?Session::get('user'):1,'post_id'=> $post->post_id])->first();
            $post->voted = $voted?$voted->liked:null;
        }
        return response()->json([
            "posts" => $posts
        ], 200);
       
    }

    function getPost(Request $request){
        $post = Post::with('user', 'images', 'comments','comments.user')->find($request->id);
        $post->votes = $post->votesNumber();
        $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
        $post->voted = $voted?$voted->liked:null;
        return  $post!= null
        ? response()->json([
            "post" => $post,
        ], 200):
        response()->json([
            "message" => 'There are no posts'
        ], 400);
    }


    public function saveFiles(Request $request, string $fileName)
    {
        $paths = [];
        foreach ($request->file($fileName) as $file) {
            $paths[] = Str::after($file->storePublicly('images', 'public'), 'images/');
        }
        return $paths;
    }

    function create(Request $request){
        $newPost = Post::create([
            'user_id'=>Session::has('user')?Session::get('user'):1,
            'title'=>$request->get('title'),
            'body'=>$request->get('description'),
        ]);


        $saved = $newPost->save();
        if ($saved) {
            $fotos = $this->saveFiles($request, 'images');
            foreach ($fotos as $foto) {
                $image = $newPost->images()->create(array('url' => $foto, 'alt'=> $newPost->title));
                $newPost->postImages()->create(array('image_id'=>$image->image_id));
            }
            $newPost->save();
        }

        $success = response()->json([
            "message" => 'Post created',
            'post' => $newPost
        ], 200);
        $error = response()->json([
            "message" => 'Error creating the post',
        ], 400);

        return $saved?$success:$error;
        //$this->createRecipe($request);
        //response()->json([ "message" => $type.' is not a valid type'], 400);
    }

    function deletePost(Request $request){
        function respond($success){
            return response()->json(['message'=>$success?'Post deleted succesfully':'Can not delete this post'],$success?200:400);
        }
        $post = Post::find($request->id);
        if($post==null)return respond(false);
        $deleted = $post->delete();
        return respond($deleted);
    }
    function deletePostRange(Request $request){
        $return = '';
        for($i=$request->first; $i<=$request->last;$i++){
            $return.= $i.', ';
            $post = Post::find($i);
            if($post!=null)$post->delete();
        }
        return response()->json(['message'=>'Deleted existent posts', 'tried'=> $return],200);
    } 

    public function votePost(Request $request){
        $vote = Vote::where([
            'user_id'=> Session::has('user') ? Session::get('user') : 1,
            'post_id'=> $request->id,
        ])->first();
    
        if ($vote == null) {
            $vote = Vote::create([
                'user_id'=> Session::has('user') ? Session::get('user') : 1,
                'post_id'=> $request->id,
                'liked' => $request->liked
            ]);
        } else {
            $vote->liked = $request->liked;
            $vote->save();
        }
    
        return response()->json(['message'=>'Voted', 'vote'=> $vote],200);
    }
}

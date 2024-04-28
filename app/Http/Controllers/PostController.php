<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    function getAllPosts(Request $request){
        return Post::count()>0?
        response()->json([
            "posts" => Post::all()
        ], 200):
        response()->json([
            "message" => 'There are no posts'
        ], 400);
    }

    function createPost(Request $request){
        //dd($request);
        $newPost = Post::create([
            'user_id'=>'1',
            'title'=>$request->data['title'],
            'body'=>$request->data['body']
        ]);
        $newPost->save();
        response()->json([
            "message" => 'Post creado con éxito',
            "id"=>$newPost->post_id
        ], 200);
    }

    function create(Request $request, $type){
        if($type == 'text')$this->createPost($request);
        else if($type == 'recipe')$this->createRecipe($request);
        else response()->json([ "message" => $type.' is not a valid type'], 400);
    }

    
}

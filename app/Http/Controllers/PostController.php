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
            "posts" => Post::with('user', 'images')->get()
        ], 200):
        response()->json([
            "message" => 'There are no posts'
        ], 400);
    }

    function getPost(Request $request){
        $post = Post::with('user', 'images')->find($request->id);
        return  $post!= null
        ? response()->json([
            "post" => $post,
        ], 200):
        response()->json([
            "message" => 'There are no posts'
        ], 400);
    }

    function createPost(Request $request){
        //dd($request);
        
        /* $newPost = Post::create([
            'user_id'=>'1',
            'title'=>$request->request->get('title'),
            'body'=>$request->request->get('description'),
            'votes'=>0,
        ]);
        //error_log($request->request->all());
        $newPost->save();
        response()->json([
            "message" => 'Post creado con éxito',
            "id"=>$newPost->post_id
        ], 200); */
    }

    function create(Request $request){
        //$this->createPost($request);
        dd($request);
        return response()->json([
            "message" => 'hola',
        ], 200);
        //$this->createRecipe($request);
        //response()->json([ "message" => $type.' is not a valid type'], 400);
    }

    
}

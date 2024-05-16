<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Str;

class PostController extends Controller
{
    function getAllPosts(Request $request){
        return Post::count()>0?
        response()->json([
            "posts" => Post::with('user', 'images')->orderByDesc('post_id')->get()
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
            'user_id'=>Session::get('user')||1,
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
            $return.= $i;
            $post = Post::find($i);
            if($post!=null)$post->delete();
        }
        return response()->json(['message'=>'Deleted existent posts', 'tried'=> $return],200);
    } 

    
}

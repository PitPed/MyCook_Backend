<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\RecipeIngredient;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;


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
            $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
            $post->voted = $voted?$voted->liked:null;
        }
        return response()->json([
            "posts" => $posts
        ], 200);
       
    }

    function getPost(Request $request){
        $post = Post::with('user', 'images', 'comments','comments.user', 'recipe', 'recipe.recipeIngredients', 'recipe.recipeIngredients.ingredient', 'recipe.recipeIngredients.measurement', 'recipe.steps', 'recipe.steps.method')->find($request->id);
        $post->votes = $post->votesNumber();
        $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
        $post->voted = $voted?$voted->liked:null;
        if($post->recipe!=null){
            $post->recipe->calculateNutrition();
        }
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
            'user_id'=>Session::get('user'),
            'title'=>$request->get('title'),
            'body'=>$request->get('description'),
        ]);

        if($request->has('recipe')){
            $recipe=json_decode($request->get('recipe'));
            $newPost->recipe()->create(['duration'=>$recipe->duration,'difficulty'=>$recipe->difficulty, 'quantity'=>$recipe->quantity]);
            foreach($recipe->recipe_ingredients as $recipe_ingredient){
                $newPost->recipe->recipeIngredients()->create(['recipe_id'=>$newPost->recipe->recipe_id, 'ingredient_id'=>$recipe_ingredient->ingredient->ingredient_id, 'measurement_id'=>$recipe_ingredient->measurement->measurement_id, 'quantity'=>$recipe_ingredient->quantity/$recipe->quantity]);
            }
            foreach($recipe->steps as $step){
                $newPost->recipe->steps()->create(['title'=>$step->title, 'description'=>$step->description, 'time'=>$step->time, 'method_id'=>$step->method->method_id]);
            }
            $newPost->save();
        }

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

    function getPostsLike(Request $request){
        $posts = Post::where('title', 'LIKE', "%$request->title%")->orderByDesc('post_id')->get();
        foreach($posts as $post){
            $post->votes = $post->votesNumber();
            $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
            $post->voted = $voted?$voted->liked:null;
        }
        return response()->json([
            "posts" => $posts
        ], 200);
    }

    public function votePost(Request $request){
        $vote = Vote::where([
            'user_id'=> Session::get('user'),
            'post_id'=> $request->id,
        ])->first();
    
        if ($vote == null) {
            $vote = Vote::create([
                'user_id'=> Session::get('user'),
                'post_id'=> $request->id,
                'liked' => $request->liked
            ]);
            return response()->json(['message'=>'Voted', 'vote'=> $vote],200);

        } 
        if($vote->liked == $request->liked){
            $vote->delete();
        }else{
            $vote->liked = $request->liked;
            $vote->save();
        }
        return response()->json(['message'=>'Voted', 'vote'=> $vote],200);
    }

    public function commentPost(Request $request){
        $comment = Comment::create([
            'user_id'=> Session::get('user'),
            'post_id'=> $request->post_id,
            'body' => $request->get('body')
        ]);
        return response()->json(['message'=>'Commented succesfully', 'comment'=> $comment],200);
    }
}

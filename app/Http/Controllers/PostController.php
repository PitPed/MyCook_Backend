<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Obtener todas las publicaciones
    function getAllPosts(Request $request){
        if(Post::count() < 1) return response()->json(["message" => 'There are no posts'], 400);
        $posts = Post::with('user', 'images', 'comments','comments.user')->orderByDesc('post_id')->get();
        foreach($posts as $post){
            $post->votes = $post->votesNumber();
            $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
            $post->voted = $voted ? $voted->liked : null;
        }
        return response()->json(["posts" => $posts], 200);
    }

    // Obtener una publicación específica
    function getPost(Request $request){
        $post = Post::with('user', 'images', 'comments','comments.user', 'recipe', 'recipe.recipeIngredients', 'recipe.recipeIngredients.ingredient', 'recipe.recipeIngredients.measurement', 'recipe.steps', 'recipe.steps.method')->find($request->id);
        $post->votes = $post->votesNumber();
        $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
        $post->voted = $voted ? $voted->liked : null;
        if($post->recipe != null){
            $post->recipe->calculateNutrition();
        }
        return $post != null
            ? response()->json(["post" => $post], 200)
            : response()->json(["message" => 'There are no posts'], 400);
    }

    // Guardar archivos en el servidor
    public function saveFiles(Request $request, string $fileName)
    {
        $paths = [];
        foreach ($request->file($fileName) as $file) {
            $paths[] = Str::after($file->storePublicly('images', 'public'), 'images/');
        }
        return $paths;
    }

    // Crear una nueva publicación
    function create(Request $request){
        $newPost = Post::create([
            'user_id' => Session::get('user'),
            'title' => $request->get('title'),
            'body' => $request->get('description'),
        ]);

        if($request->has('recipe') && $request->get('recipe') != null){
            $recipe = json_decode($request->get('recipe'));
            $newPost->recipe()->create(['duration' => $recipe->duration,'difficulty' => $recipe->difficulty, 'quantity' => $recipe->quantity]);
            if($recipe->recipe_ingredients != null){
                foreach($recipe->recipe_ingredients as $recipeIngredient){
                    $newPost->recipe->recipeIngredients()->create([
                        'recipe_id' => $newPost->recipe->recipe_id,
                        'ingredient_id' => $recipeIngredient->ingredient->ingredient_id,
                        'measurement_id' => $recipeIngredient->measurement->measurement_id,
                        'quantity' => $recipeIngredient->quantity / $recipe->quantity
                    ]);
                }
            }
            if($recipe->steps != null){
                foreach($recipe->steps as $step){
                    $newPost->recipe->steps()->create([
                        'title' => $step->title,
                        'description' => $step->description,
                        'time' => $step->time,
                        'method_id' => $step->method->method_id
                    ]);
                }
            }
            $newPost->save();
        }

        $saved = $newPost->save();
        if ($saved && $request->has('images')) {
            $fotos = $this->saveFiles($request, 'images');
            foreach ($fotos as $foto) {
                $image = $newPost->images()->create(['url' => $foto, 'alt' => $newPost->title]);
                $newPost->postImages()->create(['image_id' => $image->image_id]);
            }
            $newPost->save();
        }
        
        $newPost->load('user', 'images', 'comments','comments.user', 'recipe', 'recipe.recipeIngredients',
        'recipe.recipeIngredients.ingredient', 'recipe.recipeIngredients.measurement', 'recipe.steps', 'recipe.steps.method');

        if($newPost->recipe != null){
            $newPost->recipe->calculateNutrition();
        }

        $success = response()->json(["message" => 'Post created','post' => $newPost], 200);
        $error = response()->json(["message" => 'Error creating the post'], 400);

        return $saved ? $success : $error;
    }

    // Actualizar una publicación existente
    function updatePost(Request $request){
        $post = Post::findOrFail($request->post_id);

        if($post->user_id != Session::get('user')){
            return response()->json(["message" => 'The post must be yours to update it'], 400);
        }
        $post->title = $request->get('title');
        $post->body = $request->get('description');

        // Guarda los cambios en el post principal
        $post->save();

        // Actualiza la receta, si se proporciona
        if($request->has('recipe') && $request->get('recipe') != null){
            $recipe = json_decode($request->get('recipe'));

            // Si la receta ya existe, actualiza sus campos
            if($post->recipe){
                $post->recipe->update([
                    'duration' => $recipe->duration,
                    'difficulty' => $recipe->difficulty,
                    'quantity' => $recipe->quantity
                ]);

                // Actualiza los ingredientes de la receta, si están presentes
                if($recipe->recipe_ingredients){
                    $current_ingredients = [];
                    foreach($recipe->recipe_ingredients as $recipeIngredient){
                        $current_ingredients[] = $recipeIngredient->ingredient->ingredient_id;
                        $existingIngredient = $post->recipe->recipeIngredients()->where('ingredient_id', $recipeIngredient->ingredient->ingredient_id)->first();

                        // Si el ingrediente ya existe, actualiza su cantidad
                        if($existingIngredient){
                            $existingIngredient->update([
                                'quantity' => $recipeIngredient->quantity / $recipe->quantity
                            ]);
                        } else {
                            // Si el ingrediente no existe, créalo
                            $post->recipe->recipeIngredients()->create([
                                'ingredient_id' => $recipeIngredient->ingredient->ingredient_id,
                                'measurement_id' => $recipeIngredient->measurement->measurement_id,
                                'quantity' => $recipeIngredient->quantity / $recipe->quantity
                            ]);
                        }
                    }
                    $post->recipe->recipeIngredients()->whereNotIn('ingredient_id', $current_ingredients)->delete();
                }else{
                    $post->recipe->recipeIngredients()->delete();
                }
            }
        }
        $post->load('user', 'images', 'comments','comments.user', 'recipe', 'recipe.recipeIngredients',
         'recipe.recipeIngredients.ingredient', 'recipe.recipeIngredients.measurement', 'recipe.steps', 'recipe.steps.method');
         if($post->recipe != null){
            $post->recipe->calculateNutrition();
        }
        return response()->json(["message" => 'Post updated','post' => $post], 200);
    }

    // Eliminar una publicación
    function deletePost(Request $request){
        function respond($success){
            return response()->json(['message' => $success ? 'Post deleted successfully' : 'Can not delete this post'], $success ? 200 : 400);
        }
        $post = Post::find($request->id);
        if($post == null) return respond(false);
        $deleted = $post->delete();
        return respond($deleted);
    }

    // Eliminar un rango de publicaciones
    function deletePostRange(Request $request){
        $return = '';
        for($i = $request->first; $i <= $request->last; $i++){
            $return .= $i . ', ';
            $post = Post::find($i);
            if($post != null) $post->delete();
        }
        return response()->json(['message' => 'Deleted existent posts', 'tried' => $return], 200);
    }

    // Obtener publicaciones que coinciden con un título dado
    function getPostsLike(Request $request){
        $posts = Post::where('title', 'LIKE', "%$request->title%")->with('user', 'images', 'comments','comments.user')->orderByDesc('post_id')->get();
        foreach($posts as $post){
            $post->votes = $post->votesNumber();
            $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
            $post->voted = $voted ? $voted->liked : null;
        }
        return response()->json(["posts" => $posts], 200);
    }

    // Votar una publicación
    function votePost(Request $request){
        $vote = Vote::where([
            'user_id' => Session::get('user'),
            'post_id' => $request->id,
        ])->first();
    
        if ($vote == null) {
            $vote = Vote::create([
                'user_id' => Session::get('user'),
                'post_id' => $request->id,
                'liked' => $request->liked
            ]);
            return response()->json(['message' => 'Voted', 'vote' => $vote], 200);

        } 
        if($vote->liked == $request->liked){
            $vote->delete();
        } else {
            $vote->liked = $request->liked;
            $vote->save();
        }
        return response()->json(['message' => 'Voted', 'vote' => $vote], 200);
    }

    // Comentar una publicación
    public function commentPost(Request $request){
        $comment = Comment::create([
            'user_id' => Session::get('user'),
            'post_id' => $request->post_id,
            'body' => $request->get('body')
        ]);
        return response()->json(['message' => 'Commented successfully', 'comment' => $comment], 200);
    }
}

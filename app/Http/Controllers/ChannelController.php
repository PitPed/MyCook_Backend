<?php

namespace App\Http\Controllers;

use App\Models\PostChannel;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Channel;
use App\Models\Vote;
use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

// Función para añadir un usuario a un canal con un rol específico
function addUserToChannel($user_id, $channel_id){
    $member = Member::firstOrNew([
        'user_id'=> $user_id,
        'channel_id'=> $channel_id,
    ]);
    $member->rol = 'manager';
    $member->save();
    return true;
}

class ChannelController extends Controller
{
    // Obtener publicaciones que le han gustado a un usuario
    public function getLikedBy(Request $request){
        $user_id = $request->id?$request->id: Session::get('user');
        $likes = Vote::where([
            'user_id'=>$user_id,
            'liked'=>1
            ])->get();
        $post_ids = [];
        foreach($likes as $vote){
            $post_ids[] = $vote->post_id;
        }
        $posts = Post::whereIn('post_id', $post_ids)->with('user', 'images', 'comments','comments.user')->get();
        foreach($posts as $post){
            $post->votes = $post->votesNumber();
            $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
            $post->voted = $voted?$voted->liked:null;
        }
        return response()->json([
            'posts'=>$posts
        ]);
    }

    // Obtener publicaciones creadas por un usuario
    public function getPostedBy(Request $request){
        $user_id = $request->id?$request->id: Session::get('user');
        $posts = Post::where(['user_id'=>$user_id])->with('user', 'images', 'comments','comments.user')->get();
        foreach($posts as $post){
            $post->votes = $post->votesNumber();
            $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
            $post->voted = $voted?$voted->liked:null;
        }
        return response()->json([
            'posts'=>$posts
        ]);
    }

    // Obtener publicaciones de un canal
    public function getChannelPosts(Request $request){
        $channel = Channel::with('posts', 'posts.user', 'posts.images')->find($request->id);
        if(!$channel){
            return response()->json(['message'=>'El canal no existe']);
        }
        $posts = $channel->posts;
        foreach($posts as $post){
            $post->votes = $post->votesNumber();
            $voted = Vote::where(['user_id'=> Session::get('user'),'post_id'=> $post->post_id])->first();
            $post->voted = $voted?$voted->liked:null;
        }
        return response()->json([
            'posts'=>$posts
        ]);
    }

    // Obtener canales seguidos por un usuario
    public function getFollowedBy(Request $request){
        $user_id = $request->id!=null? $request->id : Session::get('user');
        $members = Member::where('user_id',$user_id)->get();
        $channels =[];
        foreach($members as $member){
            $channels[] = $member->channels;
        }
        foreach($channels as $channel){
            $channel->amIMember();
        }
        return response()->json([
            'channels'=>$channels
        ]);
    }

    // Obtener todos los canales públicos
    public function getAllChannels(Request $request){
        $channels = Channel::where('is_public', '!=', 0)->orderBy('name')->get();
        foreach($channels as $channel){
            $channel->amIMember();
        }
        return response()->json([
            'channels'=>$channels
        ]);
    }

    // Obtener canales que coinciden con un nombre dado
    function getChannelsLike(Request $request){
        $channels = Channel::where('name', 'LIKE', "%$request->name%")->orderBy('name')->get();
        foreach($channels as $channel){
            $channel->amIMember();
        }
        return response()->json([
            "channels" => $channels
        ], 200);
    }

    // Añadir una publicación a un canal
    public function addPostToChannel(Request $request){
        try{
            $postChannel = PostChannel::create([
                'post_id'=>$request->post,
                'channel_id'=>$request->channel
            ]);
            return response()->json(['message'=>'Post added to channel']);
        }catch(\Exception $e){
            return response()->json(['message'=> 'Error: The post can not be added to the channel'], 400);
        }
    }

    // Crear un nuevo canal
    public function createChannel(Request $request){
        if(Channel::where('name', $request->name)->exists()){
            return response()->json(['message'=> 'That channel name is being used'],400);
        }

        $channel = Channel::create(['name'=> $request->name, 'is_public'=> true, 'open_posting'=>true]);
        addUserToChannel(Session::get('user'), $channel->channel_id);
        return response()->json(['message'=>'The channel has been created! You are now a member']);
    }

    // Unirse a un canal existente
    public function joinChannel(Request $request){
        addUserToChannel(Session::get('user'), $request->id);
        return response()->json(['message'=> 'Joined the channel succesfully!'], 200);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\PostChannel;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Channel;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ChannelController extends Controller
{
    public function getLikedBy(Request $request){
        $likes = Vote::where([
            'user_id'=>$request->id,
            'liked'=>1
            ])->get();
        $posts = [];
        foreach($likes as $vote){
            $posts[] = $vote->post;
        }
        return response()->json([
            'posts'=>$posts
        ]);
    }

    public function getPostedBy(Request $request){
        $posts = Post::where(['user_id'=>$request->id])->with('user', 'images', 'comments','comments.user')->get();
        return response()->json([
            'posts'=>$posts
        ]);
    }

public function getChannelPosts(Request $request){
    DB::enableQueryLog();
    $channel = Channel::with('posts', 'posts.user', 'posts.images')->find($request->id);
    $queries = DB::getQueryLog();
    //dd($queries);
    if(!$channel){
        return response()->json(['message'=>'El canal no existe']);
    }
    return response()->json([
        'posts'=>$channel->posts
    ]);
}


    public function getFollowedBy(Request $request){
        $channels = User::find($request->id)->channels;
        return response()->json([
            'channels'=>$channels
        ]);
    }

    public function getAllChannels(Request $request){
        $channels = Channel::where('is_public', '!=', 0)->get();
        return response()->json([
            'channels'=>$channels
        ]);
    }

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
}

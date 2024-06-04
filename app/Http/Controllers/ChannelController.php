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


    public function getFollowedBy(Request $request){
        $user_id = $request->id!=null? $request->id : Session::get('user');
        $members = Member::where('user_id',$user_id)->get();
        $channels =[];
        foreach($members as $member){
            $channels[] = $member->channels;
        }
        //dd($channels);
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

    public function createChannel(Request $request){
        if(Channel::where('name', $request->name)->exists()){
            return response()->json(['message'=> 'That channel name is being used'],400);
        }

        $channel = Channel::create(['name'=> $request->name, 'is_public'=> true, 'open_posting'=>true]);
        addUserToChannel(Session::get('user'), $channel->channel_id);
        return response()->json(['message'=>'The channel has been created! You are now a member']);
    }

    public function joinChannel(Request $request){
        addUserToChannel(Session::get('user'), $request->id);
        return response()->json(['message'=> 'Joined the channel succesfully!'], 200);
    }

}

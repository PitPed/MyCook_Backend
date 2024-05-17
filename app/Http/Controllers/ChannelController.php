<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Vote;

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
}

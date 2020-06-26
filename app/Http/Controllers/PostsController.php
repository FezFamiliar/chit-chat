<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use Illuminate\Support\Facades\DB;
use App\User;
class PostsController extends Controller
{
    public function Post(Request $request){

    	$this->validate($request,[
    		'post-body' => 'required|max:2000',
    	]);

    	Auth::user()->posts()->create([ 
    		'body' => $request->input('post-body'),
    	]);

    	return redirect()->route('timeline')->with('info','Status Posted Successfully.');
    }

    public function postReply(Request $request, $statusID){

    	

    	$this->validate($request,[
    		"reply-{$statusID}" => 'required|max:2000',
    	]);

    	

    	$find_post = Post::notReply()->find($statusID);

    	if(!$find_post){
    	
    		return redirect()->route('timeline')->with('info','that post doesnt exist');
    	}

    	if(!Auth::user()->isFriendsWith($find_post->user) && Auth::user()->id != $find_post->user->id){
    
    		return redirect()->route('timeline')->with('info','you cant do that');
    	}



    	$reply = Post::create([
    		'body' => $request->input("reply-{$statusID}")
    	])->user()->associate(Auth::user());


    	$find_post->replies()->save($reply);
    	

    	return redirect()->back();
    }



    public function getLike($statusID){

        $post = Post::find($statusID);

        if(!$post)
        {
            return redirect()->route('timeline')->with('info','that post doesnt exist.');
        }

        if(!Auth::user()->isFriendsWith($post->user) && $post->user != Auth::user())
        {
            return redirect()->route('timeline')->with('info','You are not friends with that user.');
        }
        // SELECT user_id FROM `likes` WHERE like_id = post_id 
        if(Auth::user()->hasLikedPost($post))
        {
            return redirect()->route('timeline')->with('info','You already liked that post.');
        }


        $like = $post->likes()->create([]);


        Auth::user()->likes()->save($like);

        return redirect()->back();



    }


    public function showLikes($statusID){

       
       $get_like_user_id = DB::select("SELECT user_id FROM `likes` WHERE like_id = {$statusID}");
      
       for($i = 0;$i < count($get_like_user_id);$i++)
       {
            $get_users[] =  DB::select("SELECT name FROM `users` WHERE id = {$get_like_user_id[$i]->user_id}")[0]->name;
       }

        return response()->json(['success'=> $get_users]);
    }


    public function DeletePost($statusID)
    {

            $post = Post::find($statusID);

            if(!$post)
            {
                return redirect()->route('timeline')->with('info','that post doesnt exist.');
            }
            else
            {

                if(Auth::user()->id != $post->user_id)
                {
                    return redirect()->route('timeline')->with('info','You can\'t delete that post.');
                }
            }

            $post->delete();

            return redirect()->back()->with('info','Post Deleted Successfully.');
            
    }

    public function EditPost(Request $request)
    {
        
        $id = $request->input('id');
        $data = $request->input('data');

        $post = Post::find($id)->update(['body' => $data]);

    }
}

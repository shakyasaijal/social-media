<?php

namespace App\Http\Controllers\Admin\Api\V1;

use App\Events\BroadcastMessages;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\LikeDislike;
use App\Models\Message;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class ApiController extends Controller
{

    public function getComments($blog_id)
    {
        $comments = Comment::with('user')->whereBlogId($blog_id)->orderBy('created_at', 'ASC')->get();
        $comments_by_id = new Collection;

        foreach ($comments as $comment)
        {
            $comments_by_id->put($comment->id, $comment);
        }

        foreach ($comments as $key => $comment)
        {
            $comments_by_id->get($comment->id)->children = new Collection;
            $comments_by_id->get($comment->id)->userAvatar = $comment->user->getFullPhotoPath();
            if ($comment->parent_id != null)
            {
                $comments_by_id->get($comment->parent_id)->children->push($comment);
                unset($comments[$key]);
            }
        }
        return response()->json(['success' => true, 'data' => $comments], 200);
    }

    public function addNewComment(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'comment' => 'required|min:1',
            'parent_id'=>'nullable'
        ]);

        $comment = Comment::create([
            'blog_id' => $request->input('blog_id'),
            'comment' => $request->input('comment'),
            'parent_id'=>$request->input('parent_id')?$request->input('parent_id'):null
        ]);

        $data = [
            'id' => $comment->id,
            'comment' => $comment->comment,
            'user'=>$comment->user,
            'userAvatar'=>$comment->user->getFullPhotoPath(),
            'children'=>[],
            'reply_box'=>false,
            'created_at' => $comment->created_at->format('M d, Y H:i')
        ];
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function totalLikeDislike($blog_id)
    {
        $blog = Blog::find($blog_id);
        $total_number_of_like = $blog->likeDislikes()->where('like_dislike', 1)->count();
        $total_number_of_dislike = $blog->likeDislikes()->where('like_dislike', 0)->count();
        $data = [
            'total_likes' => $total_number_of_like,
            'total_dislikes' => $total_number_of_dislike
        ];
        return response()->json(['data' => $data], 200);
    }

    public function checkIfCreateLike($blog_id)
    {
        // $blog = Blog::find($blog_id);
        $user_id = Auth::id();
        $like_dislike = LikeDislike::where('blog_id', $blog_id)
                ->where('user_id', $user_id)
                ->first();

        if ($like_dislike) {
            if($like_dislike->like_dislike==0){
                return [
                    'param'=>'dislike',
                    'like_dislike_id'=>$like_dislike->id
                ];
            }else{
                return [
                    'param'=>'like',
                    'like_dislike_id'=>$like_dislike->id
                ];
            }
        } else {
            return 'create-new';
        }
    }

    public function postLikeDislike(Request $request, $blog_id)
    {
        $param = $request->input('param');
        $status = $this->checkIfCreateLike($blog_id);

        if (!is_array($status) && $status =='create-new') {
            LikeDislike::create([
                'blog_id' => $blog_id,
                'like_dislike' => $param
            ])->save();
        }

        if(is_array($status) && $status['param']=='like'){
                $like_dislike_id = $status['like_dislike_id'];
                $update = LikeDislike::where('id',$like_dislike_id)->first();
                if($param != 1 || false){
                    $update->like_dislike = 0;
                }
                $update->save();
        }

        if(is_array($status) && $status['param']=='dislike'){
            $like_dislike_id = $status['like_dislike_id'];
            $update = LikeDislike::where('id',$like_dislike_id)->first();
            if($param !=0  || false){
                $update->like_dislike = 1;
            }
            $update->save();
        }
        return response()->json(['success' => true], 200);
    }

    public function fetchMessages($friend_id)
    {
        $user_id = Auth::id();

        $messages = Message::where(function($query) use($user_id,$friend_id){
            $query->where('user_id',$user_id)->where('friend_id',$friend_id);
        })->orWhere(function($query) use($user_id,$friend_id){
            $query->where('friend_id',$user_id)->where('user_id',$friend_id);
        })->get();
        return response()->json(['messages'=>$messages],200);
    }

    public function getSelectedFriend($friend_id){
        return response()->json(['friend'=>User::find($friend_id)],200);
    }

    public function getAuthenticateUserDetails(){
        return response()->json(['user'=>Auth::user()],200);
    }

    public function storeMessage(Request $request){
        $this->validate($request,[
           'user_id'=>'required',
            'message'=>'required',
            'friend_id'=>'required'
        ]);
        $message = Message::create([
            'message'=>$request->input('message'),
            'user_id'=>$request->input('user_id'),
            'friend_id'=>$request->input('friend_id')
        ]);
        //
        //broadcast recently created message from here
        broadcast(new BroadcastMessages($message))->toOthers();
        return response()->json(['message'=>$message],200);
    }

}

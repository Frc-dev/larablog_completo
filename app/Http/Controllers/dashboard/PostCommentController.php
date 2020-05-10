<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostComment;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['auth', 'rol.admin']);
    }
    public function index()
    {
        $postComments = PostComment::orderBy('created_at', 'desc')->paginate(2);
        // select * from postComments

        return view('dashboard.post-comment.index',[
            'postComments' => $postComments
        ]);
    }

    public function post(Post $post)
    {

        $posts = Post::all();

        $postComments = PostComment
        ::orderBy('created_at', 'desc')
            ->where('post_id', '=', $post->id)
            ->paginate(10);
        // select * from postComments

        return view('dashboard.post-comment.post',[
            'postComments' => $postComments,
            'posts' => $posts,
            'post' => $post
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PostComment $postComment)
    {
        //$postComment = PostComment::findOrFail($id);

        return view('dashboard.post-comment.show', ["postComment" => $postComment]);

    }

    public function jshow(PostComment $postComment)
    {
        //$postComment = PostComment::findOrFail($id);

        return response()->json($postComment);


    }

    public function proccess(PostComment $postComment){
        $postComment->approved == '0' ?
            $postComment->approved == '1' :
            $postComment->approved == '0';
        $postComment->save();

        return response()->json($postComment->approved);
    }
    public function destroy(PostComment $postComment)
    {
        $postComment->delete();
        return back()->with('status', 'Comentario eliminado con éxito');

    }
}

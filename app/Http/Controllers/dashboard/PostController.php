<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\PostsExport;
use App\Helpers\CustomUrl;
use App\Http\Requests\StorePostPost;
use App\Http\Requests\UpdatePostPut;
use App\Imports\PostsImport;
use App\Post;
use App\PostImage;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['auth', 'rol.admin']);
    }

    public function export(){
       return Excel::download(new PostsExport, 'posts.xlsx');
    }

    public function import(){
        Excel::import(new PostsImport, 'posts.xlsx');
        return "Importado con éxito";
    }
    public function index(Request $request)
    {
        Storage::get("img.png");





        /*DB::transaction(function(){
            DB::table('contacts')
                ->where(['id' => 1])
                ->update(['name' => 'Juan']);

            DB::table('contacts')
                ->where(['id' => 1])
                ->delete();
        });*/
        /*DB::beginTransaction();
        DB::table('contacts')
            ->where(['id' => 1])
            ->update(['name' => 'Juan']);

        DB::table('contacts')
            ->where(['id' => 1])
            ->delete();
        DB::rollBack();*/

        /*$personas = ['usuario 1', 'usuario 2', 'usuario 3', 'usuario 4'];

        $collection1 = collect($personas);
        $collection2 = new Collection($personas);
        $collection3 = Collection::make($personas);

        $collection2->sum('edad');
*/
        $posts = Post
            ::with('category')
            ->orderBy('created_at', request('created_at'));

        if($request->has('search')) {
            $posts = $posts->where('title', 'like', '%' . request('search') . '%');
        }
            $posts = $posts->paginate(2);
        // select * from posts

        return view('dashboard.post.index',[
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        CustomUrl::hola_mundo();
        $tags = Tag::pluck('id', 'title');
        $categories = Category::pluck('id', 'title');
        $post = new Post();

        return view('dashboard.post.create',[
            'post' => new Post(),
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostPost $request)
    {

        //$request->validate();

        if($request->url_clean == ""){
            $urlClean = CustomUrl::urlTitle(CustomUrl::convertAccentedCharacters($request->title),'-', true);
        }
        else{
            $urlClean = $request->url_clean;
        }

        $requestData = $request->validated();

        $requestData['url_clean'] = $urlClean;

        $validator = Validator::make($requestData, StorePostPost::myRules());

        if($validator->fails()){
            return redirect('dashboard/post/create')
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::create($requestData);
        $post->tags()->sync($request->tags_id);
        return back()->with('status', 'Post creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //$post = Post::findOrFail($id);

        return view('dashboard.post.show', ["post" => $post]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $tags = Tag::pluck('id', 'title');
        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit',
            compact('post', 'categories', 'tags'
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostPut $request, Post $post)
    {
        $post->tags()->sync($request->tags_id);

        $post->update($request->validated());

        return back()->with('status', 'Post actualizado con éxito');
    }

    public function image(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'required | mimes:jpeg,bmp,png,jpg,gif | max:20480' //20 mb
        ]);

        $filename = time() . "." . $request->image->extension();
        //$request->image->move(public_path('images'));

        $path = $request->image->store('public');

        PostImage::create([
            'image' => $path,
            'post_id' => $post->id
        ]);

        return back()->with('status', 'Imagen cargada con éxito');

    }

    public function contentImage(Request $request)
    {
        $request->validate([
            'image' => 'required | mimes:jpeg,bmp,png,jpg,gif | max:20480' //20 mb
        ]);

        $filename = time() . "." . $request->image->extension();
        $request->image->move(public_path('images'), $filename);


        return response()->json(["default" => URL::to('/'). '/images/' . $filename]);


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('status', 'Post eliminado con éxito');

    }

    public function imageDownload(PostImage $image){
        return Storage::disk('local')->download($image->image);
    }

    public function imageDelete(PostImage $image){
        $image->delete();
        Storage::disk('local')->delete($image->image);
        return back()->with('status', 'Imagen eliminada con éxito');
    }

    private function sendMail(){

        $data['title'] = "Hola amigo";

        Mail::send('emails.email', $data, function($message){
            $message->to('andres@gmail.com', 'Pepito')
                ->subject("Gracias por escribirnos");
        });

        if(Mail::failures()){
            return "Mensaje no enviado";
        }
        else{
            return "Mensaje enviado";
        }
    }

}

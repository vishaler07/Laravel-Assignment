<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\User;
use App\Repositories\PostRepository;
class PostsController extends Controller
{

    protected $postRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->middleware('auth');
        $this->postRepository=$postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // $posts=Post::orderBy('created_at','desc')->get();
        $posts=$this->postRepository->all();
        $is_admin=false;
        $user=auth()->user();
        $user_id=auth()->user()->id;
        if($user->isAdmin)
            $is_admin=true;

        if($is_admin==true)
           return view("posts.postpage",compact("posts",'is_admin'));
        abort('404');
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $is_admin=false;
        $user=auth()->user();
        $user_id=auth()->user()->id;
        if($user->isAdmin)
            $is_admin=true;

        if($is_admin==true)
            return view('posts.createnewpost');
        abort('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function image_assist(Request $request)
    {
        # code...
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
		
	    // make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('cover_image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/cover_images/'.$thumbStore);
		
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        return $fileNameToStore;
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            "title"=>"required",
            "body"=>"required",
            'cover_image'=>'image|nullable|max:1999'
        ]);

        $fileNameToStore=$this->image_assist($request);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/admin/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $posts=Post::find($id);
        $posts=$this->postRepository->findByID($id);
        $is_admin=false;
        $user=auth()->user();
        $user_id=auth()->user()->id;
        if($user->isAdmin)
            $is_admin=true;
        if($is_admin==true)
            return view('posts.showpost',compact('posts','is_admin'));
        abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=$this->postRepository->findByID($id);
        $posts=Post::orderBy('created_at','desc')->get();
        $is_admin=false;
        $user=auth()->user();
        $user_id=auth()->user()->id;
        if($user->isAdmin)
            $is_admin=true;

        if($is_admin==true)
            return view('posts.editpost')->with('post',$post);
        abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            "title"=>"required",
            "body"=>"required"
        ]);

        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
		
	    // make thumbnails
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('cover_image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/cover_images/'.$thumbStore);
		
        }

        $post=$this->postRepository->findByID($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image=$fileNameToStore;
        }
        $post->save();

        return redirect('/admin/posts')->with('success','Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post=$this->postRepository->findByID($id);

        // $posts=Post::orderBy('created_at','desc')->get();
        $posts=$this->postRepository->all();
        $is_admin=false;
        $user=auth()->user();
        $user_id=auth()->user()->id;
        if($user->isAdmin)
            $is_admin=true;
        
        if($is_admin==true)
        {
            
            //Check if post exists before deleting
            if (!isset($post)){
                return redirect('/posts')->with('error', 'No Post Found');
            }

            // Check for correct user
            // if(auth()->user()->id !==$post->user_id){
            //     return redirect('/posts')->with('error', 'Unauthorized Page');
            // }

            if($post->cover_image != 'noimage.jpg'){
                // Delete Image
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
            
            $post->delete();
            return redirect('/admin/posts')->with('success', 'Post Removed');
        }
        else
            abort('404');

    }
}

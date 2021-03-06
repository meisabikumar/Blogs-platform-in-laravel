<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// for storage
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $posts = Post::all();
        // return Post::where('title','Post Two')->get();
        // $posts=DB::select('select * from posts')
        // $posts = Post::orderBy('title','desc')->take(1)->get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);

        // $images=DB::select('select cover_image from posts');
        // $cover_images = json_decode($images);
        // $post->cover_image=json_encode($data);
        
        // $posts = Post::orderBy('title','desc')->get();
        // return $posts;
        
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image.*'=>'image|nullable|max:1999'
            // 'cover_image'=>'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //handle file upload

        

        if($request->hasFile('cover_image')){
            
            foreach($request->file('cover_image') as $x)
            {
                // Get filename with extension
            $fileNameWithExt=$x->getClientOriginalName();
            // Get just file name
            $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get just ext
            $extension=$x->getClientOriginalExtension();
            //File name to store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;   
            //upload image
            $path=$x->storeAs('public/cover_images',$fileNameToStore);

            $data[] = $fileNameToStore;  
            }
        }else{
            $fileNameToStore='noimage.jpg';
        }

        // Create post

        $post = new Post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id=auth()->user()->id;
        $post->cover_image=json_encode($data);
        $post->save();

        
        

        


        // return json_encode($data);

        return redirect('/posts')->with('success','Post Created');
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //check for correct user

        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','unauthorize page');
        }

        return view('posts.edit')->with('post',$post);
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
            'title'=>'required',
            'body'=>'required'
        ]);
        
        //handle file upload

        if($request->hasFile('cover_image')){
            // Get filename with extension
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            // Get just file name
            $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get just ext
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore=$fileName.'_'.time().'.'.$extension;   
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        // Create post

        $post = Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();



        return redirect('/posts')->with('success','Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);

        //check for correct user

        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','unauthorize page');
        }

        if($post->cover_image !='noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Deleted');

    }
}

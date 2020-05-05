<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Gate;
use App\LostItem;
use App\Category;
use URL;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth', [
            'except' => ['index', 'show', 'category']
        ]);
    }

    /**
     * Display a list of all the posts and categories to choose from
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //shows all categories
        $categories = Category::all();
        //order by latest created at the top to the oldest created at the bottom
        $posts = LostItem::orderBy('created_at', 'desc')->get();

        return view('posts.index')->with('posts', $posts)->with('categories', $categories);
    }


    /**
     * Show the form for creating a new post
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //this gets all the categories first and then returns 
        $categories = Category::all();
        return view('posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created post into the database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Checks if the following have been inputted
        $this->validate($request, [
            'title' => 'required',
            'type_id' => 'required',
            'description' => 'required',
            //states that only image files are allowed with max size 2mb
            'cover-image' => 'image|nullable|max:1999'
        ]);

        //Checks if there is an image
        if($request->hasFile('cover_image')){
            // Gets the original file name
            $theFile = $request->file('cover_image');
            // Gets just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Gets the filename to store
            $theFile->move(public_path().'/cover_images', $theFile->getClientOriginalName());
            // Gets the filename to store
            $url = URL::to("/").'/cover_images'.'/'.$theFile->getClientOriginalName();
        } else {
            //This noimage will be the image to store
			$url = 'noimage.jpg';
        }

        //Creates a LostItem and stores entries into database
        $posts = new Lostitem();
        $posts->title = $request->input('title');
        $posts->description = $request->input('description');
        $posts->colour = $request->input('colour');
        $posts->found_location = $request->input('found_location');
        $posts->type_id = $request->input('type_id');
        $posts->user_id = auth()->user()->id;
        $posts->cover_image = $url;
        //saves the post in the database

        $posts->save();

        //post submitted
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = LostItem::find($id);
        return view('posts.show')->with('posts', $posts);
    }

    /**
     * Show the form for editing a post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $posts = LostItem::find($id);
        
        //Only users who made the post can edit as well as the admins can edit the post
        if(auth()->user()->id !==$posts->user_id && auth()->user()->role != 1){
            return view('/posts')->with('error', 'Unauthorized Page');
        } 

        return view('posts.edit')->with('posts', $posts)->with('categories', $categories);
    }

    /**
     * Update the specified post and store it back into the database.
     * Similar to function store
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'type_id' => 'required',
            'description' => 'required',
            'colour' => 'required',
            'found_location' => 'required'
        ]);

        if($request->hasFile('cover_image')){
			// Gets the original file name
            $theFile = $request->file('cover_image');
            // Gets just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Gets the filename to store
            $theFile->move(public_path().'/cover_images', $theFile->getClientOriginalName());
            // Gets the filename to store
            $url = URL::to("/").'/cover_images'.'/'.$theFile->getClientOriginalName();
        }

        $posts = LostItem::find($id);
        $posts->title = $request->input('title');
        $posts->type_id = $request->input('type_id');
        $posts->description = $request->input('description');
        $posts->colour = $request->input('colour');
        $posts->found_location = $request->input('found_location');
        if($request->hasFile('cover_image')){
            $posts->cover_image = $url;
        }
        $posts->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified post from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //finds id of the post
        $post = LostItem::find($id);
        
        //Only the user who made the post can delete it
        if(auth()->user()->id != $post->user_id && auth()->user()->role != 1){
            return view('/posts')->with('error', 'Unauthorized Page');
        }

        //deletes the cover image
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        //deletes the post
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }

    
    public function category($id){

        //gets all categories
        $categories = Category::all();

        //gets all posts
        $posts = LostItem::all();


        //Checks if each post type id is equal to an id of an existing category
        $posts = $posts->filter(function ($value, $key) use ($id){
            return $value->type_id == $id;
        });

        //returns post page with all categories and posts to choose from
        return view('posts.index')->with('categories', $categories)->with('posts', $posts);
    }





}

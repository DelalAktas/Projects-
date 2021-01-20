<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Blog as BlogResource;
use App\User;
use App\Blog;
use Auth;
class ApiBlogController extends Controller
{
    public function index()
    {
        return BlogResource::collection(Blog::all());
    }
    public function show(Blog $blog)
    {
        return new BlogResource($blog);
    }
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response()->json(null, 204);
    }
    public function update(Blog $blog)
    {
        $blog->title = request('title');
        $blog->description = request('description');
        
        $blog->save();

        return new BlogResource($blog);

        
    }
    public function store()
    {   
        $blog = new Blog();
        $user = new User();
        $id=Auth::user()->id;
        $blog->title = request('title');
        $blog->description = request('description');
        $blog->user_id=request('user_id');
        //$blog->user_id=$user->$id;
        //$user = Auth::user()->user_id;
       
        $blog->save();

        return new BlogResource($blog);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Storage;
use Image;
use PDF;
use Auth;
class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['overview','show','BlogDepth', 'about', 'index']]);
        //$this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::take(10)->latest()->paginate(10);

        return view('pages.overview',  ['pages' => $blog]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
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
            'title' => 'required',
            'body'=>'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);

        // Create blog
        $blog = new Blog;
        $blog ->title = $request->input('title');
        $blog ->description = $request->input('body');
        $blog ->user_id = auth()->user()->id;

        if($request->hasFile('cover_image')){

            $image = $request->file('cover_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/uploads/avatars/' . $filename);
            $watermark = Image::make(public_path('/uploads/avatars/' . 'watermark.png'));
            Image::make($image)->resize(250,250)->insert($watermark->resize(150,150), 'center')->save($location);


            $blog->cover_image = $filename;
        }
        $blog->save();

        return redirect('/')->with('success', 'Blog Created!');


        /*//Handle file upload
        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore= $filename.'_'.time().'.'.$extension;

            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        else{
            $fileNameToStore ='noimage.jpg';
        }
        //Create a blog
        $blog = new Blog;
        $blog ->title = $request->input('title');
        $blog ->description = $request->input('body');
        $blog ->user_id = auth()->user()->id;
        $blog ->cover_image = $fileNameToStore;
        $blog->save();

        return redirect('/')->with('success', 'Blog has been created');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('pages.show', ['pages' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        //if(Auth::guard('admin')){
        //    $blog ->delete();
        //    return redirect('/')->with('success', 'Blog has been removed');
        //}
        if(auth()->user()->id !==$blog->user_id){
            return redirect('/')->with('error', 'You are not authorized to visit this page');
        }

        return view('pages.edit', ['pages' => $blog]);
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
            'title' => 'required',
            'body'=>'required',
        ]);
        //Handle file upload
        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('cover_image')->getClientOriginalExtension();

            $fileNameToStore= $filename.'_'.time().'.'.$extension;

            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        //Create a blog
        $blog = Blog::find($id);
        $blog ->title = $request->input('title');
        $blog ->description = $request->input('body');
        if($request->hasFile('cover_image')){
            $blog ->cover_image = $fileNameToStore;
        }
        $blog->save();

        return redirect('/')->with('success', 'Blog has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if(Auth::guard('admin')){
            $blog ->delete();
            return redirect('/')->with('success', 'Blog has been removed');
        }
        if(auth()->user()->id !==$blog->user_id){
            return redirect('/')->with('error', 'You are not authorized to visit this page');
        }

        if($blog->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$blog->cover_image);
        }

        $blog ->delete();
        return redirect('/')->with('success', 'Blog has been removed');
    }

    public function indexDepth(){
        $blog = Blog::take(50)->latest()->paginate(50);

        return view('pages.BlogDepth',  ['pages' => $blog]);
    }
    public function downloadPDF($id) {
        $blogs = Blog::find($id);
        $pdf = PDF::loadView('pdf', compact('blogs'));

        return $pdf->download('blog_'.$id.'.pdf');
    }
    
}

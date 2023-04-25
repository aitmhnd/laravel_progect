<?php

namespace App\Http\Controllers;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use App\Http\Request\PostRequest;

class homeController extends Controller
{
    //

    public function index(){

      $posts = post::latest()->paginate(3);
            return view('home')->with([
                 'posts'=> $posts,
              
            ]);

    }
    public function show($slug){
      $post= Post::where('slug',$slug)->first();
      return view('show')->with([
        'post' => $post

      ]);

    }
public function create(){

  return view('create');
}
public function store(Request $request)

{    $this->validate($request,[
        'title' => 'Required',
        'body' => 'Required',
        'image' =>'Required',

]);


      if($request->has('image')){
           $file = $request->image;
           $image_name = time().'_'.$file->getClientOriginalName();
           $file->move(public_path('uploads'),$image_name);
      }

     post::create([
          'title' => $request->title,
          'body' => $request->body,
          'slug' => str::slug($request->title),
          'image' => $image_name,
          'user_id' => auth()->user()->id,
]);
    return redirect()->route('home')-> with([
        'success' => ' Post has ben added successfuly '

    ]);
    
}         public function edit($slug){

              $post= Post::where('slug',$slug)->first();
               return view('edit')->with([
                 'post' => $post

  ]);
  }
            public function update(Request $request, $slug){

              $post= Post::where('slug',$slug)->first();

              if($request->has('image')){
                  $file = $request->image;
                  $image_name = time().'_'.$file->getClientOriginalName();
                  $file->move(public_path('uploads/'),$image_name);
                  unlink(public_path('uploads/').$post->image);
                  $post->image = $image_name;
                  
                  }
                   $post->update([
                           'title' => $request->title,
                           'body' => $request->body,
                           'slug' => str::slug($request->title),
                           'image' => $post->image,
                           'user_id' => auth()->user()->id,
                   ]);
                   return redirect()->route('home')-> with([ 

                    'success' => 'article modifide'
                   ]);
                  
}
             public function delete($slug){    

               $post= Post::where('slug',$slug)->first();
               unlink(public_path('uploads/').$post->image);
               $post->delete();
                   return redirect()->route('home')->with([

                    'success' => 'article deleted'
                   ]); 
     
                 
                  }
                  
      

}
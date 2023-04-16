<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;


class BlogController extends Controller
{
     public function index()
     {
        return view('dashboard.dashboard');
     }

     public function create(Request $request)
     {

            $validator = Validator::make($request->all(), [
               'title' => 'required',   
               'blog' => 'required',
               'blog_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

         ]); 
         if ($validator->fails())   
         {
               return response()->json(['error'=>'request has no data', 'data'=>'All the form data is requried']);  
         } 
         $file = $request->file('blog_image');
         // $file = $request->blog_image;

         // $filename = $request->blog_image->getClientOriginalName();
         $filename = $request->file('blog_image')->getClientOriginalName();

         $path = $request->file('blog_image')->store('uploads');

          $slug=Str::slug($request->title,'-');
       
         $entry_time = \Carbon\Carbon::now();
         $userid=Auth::User()->id;

         $data=array('users_id'=>$userid,'title'=>$request->title,'blog'=>$request->blog,'slug'=>$slug,'blog_date'=>$entry_time,'blog_image'=>$path);

         $result=Blog::create($data);

         if(!empty($result))
         {
              return response()->json(['message'=>'Blog Created succesfully',"redirect_location"=>url("blog/show")]);
         }
     }
 
      public function show()
      {
         $userid=Auth::User()->id;

         // $allblogs=Blog::all()->where('users_id',$userid);

         $allblogs=Blog::where('users_id',$userid)->paginate(5);


          if(!empty($allblogs))
          {
            return view('dashboard.show',compact('allblogs'));
          }
      }

      public function edit($slug)
      {
         $purl=url('/');
         // dd($purl);
         $userid=Auth::User()->id;
         $editdata=Blog::where('slug',$slug)->where('users_id',$userid)->first();

         if(!empty($editdata))
         {
             return response()->json(['editdata'=>$editdata,'projectUrl'=>$purl]);
         }
      }

      public function update(Request $request, $slug,Blog $blog)
      {
         $updatedblog=array();
         $userid=Auth::User()->id;
         if ( $request->file('blog_image')) {
            $filename = $request->file('blog_image')->getClientOriginalName();
            $path = $request->file('blog_image')->store('uploads');
   
         //   if ($post->image) {
         //     Storage::delete('public/images/' . $post->image);
         //   }
         }
     
         $blogdata = Blog::where('slug',$slug)->where('users_id',$userid)->first();

         if($blogdata->title!=$request->title)
         {
            $updated_slug=Str::slug($request->title,'-');
            $updatetitle = ['title' => $request->title,'slug'=>$updated_slug];
         }
         else{
            $updatetitle = ['title' => $request->title,'slug'=>$slug];
         }
         $entry_time = \Carbon\Carbon::now();

    
            if( $request->file('blog_image'))
            {
               $updatedblog = [ 'blog' => $request->blog,'blog_image'=>$path,'blog_date'=>$entry_time];
            }
            else{
               $updatedblog = ['blog' => $request->blog,'blog_date'=>$entry_time];
            }

            $finaldata=array_merge($updatetitle,$updatedblog);

         $editdata=Blog::where('slug',$slug)->where('users_id',$userid)->update($finaldata);
         return redirect('blog/show')->with(['message' => 'Post updated successfully!', 'status' => 'success']);

      }
      public function delete($slug)
      {
         // dd($slug);
         $userid=Auth::User()->id;
         $data=Blog::where('slug',$slug)->where('users_id',$userid)->delete();
         return response()->json(['message'=>'Blog deleted succesfully',"redirect_location"=>url("blog/show")]);

      }

      public function publish(Request $request, $slug)
      {
         $userid=Auth::User()->id;
         $publish=array('is_publish'=>1);
         $data=Blog::where('slug',$slug)->where('users_id',$userid)->update($publish);
         // return redirect('blog/show')->with(['message' => 'Post updated successfully!', 'status' => 'success']);
         return response()->json(['message'=>'Published',"redirect_location"=>url("blog/show")]);

      }

}

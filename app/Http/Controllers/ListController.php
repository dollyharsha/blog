<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class ListController extends Controller
{
    public function index()
    {
        $allblogs=Blog::where('is_publish',1)->paginate(5);

        // dd($allblogs);
    
        if(!empty($allblogs))
          {
            return view('Bloglist',compact('allblogs'));
          }
    }
}

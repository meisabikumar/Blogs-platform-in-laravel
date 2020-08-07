<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function index(){
        $title ="this is index page";
        // return view('pages.index',compact('title'));
        return view('pages.index')->with('title',$title);
    }

    public function about(){
        $title ="this is About page";
        return view('pages.about')->with('title',$title);;
    }

    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=> ['web Design','programming','seo ']
        );
        return view('pages.services')->with($data);;
    }
}

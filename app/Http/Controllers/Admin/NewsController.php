<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\news;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['news'] = news::all();
        return view('admin.news.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['categories'] = Category::all();
        return view('admin.news.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,news $news)
    {
        if(isset($request->image) && $request->image->getClientOriginalName())
        { 
            $ext = $request->image->getClientOriginalExtension();
            $file = date('Ymdhis').rand(1,99999).'.'.$ext;
            $request->image->storeAs('public/news',$file);
        }
        else
        {
            $file = '';
        }
         $news->image = $file;
         $news->category_id = $request->categroy_id;
         $news->title = $request->title;
         $news->author = $request->author;
         $news->desc = $request->desc;
         $news->save();
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(news $news)
    {
        $arr['categories'] = Category::all();
        $arr['news'] = $news;
        return view('admin.news.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, news $news)
    {
         if(isset($request->image) && $request->image->getClientOriginalName())
        { 
            $ext = $request->image->getClientOriginalExtension();
            $file = date('Ymdhis').rand(1,99999).'.'.$ext;
            $request->image->storeAs('public/news',$file);
        }
        else
        {
            if(!$news->image)
                $file = '';
            else 
                $file = $news->image;
            
        }
         $news->image = $file;
         $news->category_id = $request->categroy_id;
         $news->title = $request->title;
         $news->author = $request->author;
         $news->desc = $request->desc;
         $news->save();
        return redirect()->route('admin.news.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(news $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index');
    }
}

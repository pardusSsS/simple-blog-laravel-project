<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Article;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','DESC')->get();

        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryModel::orderBy('created_at','DESC')->get();

        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'title'=>'min:4',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

     $validate = Validator::make($request->all(),$rules);

     if($validate->fails()){
         return redirect()->route('admin.makaleler.create')->withErrors($validate)->withInput();
     }

        $article = new Article();
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->contentt;
        $article->status = $request->status;
        $article->slug = str_slug($request->title);

        if($request->hasFile('image')){
            $imgName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imgName);
            $article->image='uploads/'.$imgName;
        }
        $article->save();

        return redirect()->route('admin.makaleler.index');
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
    public function edit($id)
    {
        $article=Article::findOrFail($id);
        $categories = CategoryModel::orderBy('created_at','DESC')->get();

        return view('back.articles.update',compact('categories','article'));
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
        $rules = [
            'title'=>'min:4',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validate = Validator::make($request->all(),$rules);

        if($validate->fails()){
            return redirect()->route('admin.makaleler.create')->withErrors($validate)->withInput();
        }

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->contentt;
        $article->status = $request->status;
        $article->slug = str_slug($request->title);

        if($request->hasFile('image')){
            $imgName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imgName);
            $article->image='uploads/'.$imgName;
        }
        $article->save();

        return redirect()->route('admin.makaleler.index');
    }

    public function switchh(Request $request){
        $article = Article::findOrFail($request->id);
        $article->status = $request->statu=="true" ? 1 : 0 ;
        $article->save();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        return redirect()->route('admin.makaleler.index');
    }

    public function allDelete(){
       Article::getQuery()->delete();
        //DB::table('articles')->delete();

       // Article::truncate();


        return redirect()->route('admin.makaleler.index');

    }

    public function trashed(){
        $articles = Article::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('back.articles.trashed',compact('articles'));

    }


    public function recoveryy($id){

           Article::onlyTrashed()->find($id)->restore();

           return redirect()->route('admin.trashed.article');
    }

    public function hardDelete($id){

//        Article::onlyTrashed()->findOrFail($id)->forceDelete();

        $article = Article::onlyTrashed()->find($id);
        if(File::exists($article->image)){
          File::delete(public_path($article->image));
        }

        $article->forceDelete();
        return redirect()->route('admin.makaleler.index');

    }
}

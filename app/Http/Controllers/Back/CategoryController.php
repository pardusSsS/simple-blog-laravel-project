<?php

namespace App\Http\Controllers\Back;

use App\Models\Article;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryModel::orderBy('id','ASC')->get();
        return view('back.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isExist = CategoryModel::whereSlug(str_slug($request->name))->first();
        if ($isExist) {
            $msg = $request->name . " adında bir kategoriniz mevcut. Lütfen başka bir kategori ismi giriniz";
            return redirect()->route('admin.categories.index')->with('msg', $msg);
        } else {


            $data = new CategoryModel();
            $data->name = $request->name;
            $data->slug = str_slug($request->name);
            $data->save();

            return redirect()->route('admin.categories.index');
        }
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
        //
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
         $isName=CategoryModel::whereName($request->name)->whereNotIn('id',[$request->id])->first();
        $isSlug = CategoryModel::whereSlug(str_slug($request->name))->whereNotIn('id',[$request->id])->first();
        if ($isSlug || $isName)  {
            $msg = $request->name . " adında bir kategoriniz mevcut. Lütfen başka bir kategori ismi giriniz";
            return redirect()->route('admin.categories.index')->with('msg', $msg);
        } else {


            $data = CategoryModel::findOrFail($request->id);
            $data->name = $request->name;
            $data->slug = str_slug($request->slug);
            $data->save();

            return redirect()->route('admin.categories.index');
        }
    }


    public function updatee(Request $request)
   {
        $isSlug = CategoryModel::whereSlug(str_slug($request->slug))->first();
         $isName=CategoryModel::whereName($request->category)->first();

        if ($isSlug or $isName)  {
            $msg = $request->category . " adında bir kategoriniz mevcut. Lütfen başka bir kategori ismi giriniz";
            return redirect()->route('admin.categories.index')->with('msg', $msg);
        } else {


            $data = CategoryModel::find($request->id);
            $data->name = $request->category;
            $data->slug = str_slug($request->slug);
            $data->save();

            return redirect()->route('admin.categories.index');
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }

public function deletecat(Request $request){

    $category=CategoryModel::find($request->id);


    if($category->id==1){
        $msg = $category->name . " kategorisi sabit bir kategoridir. Silinemez.";
        return redirect()->route('admin.categories.index')->with('msg', $msg);
    }else{
        Article::where('category_id',$category->id)->update(['category_id'=>1]);
    }
    $category->delete();

    $msg = $category->name . " adlı kategoryi başarılı bir şekilde sildiniz.";
    return redirect()->route('admin.categories.index')->with('msg', $msg);

}




    public function getData(Request $request){
        $category= CategoryModel::findOrFail($request->id);
        return response()->json($category);
     }





}

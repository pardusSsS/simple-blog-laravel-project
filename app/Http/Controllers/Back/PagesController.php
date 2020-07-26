<?php

namespace App\Http\Controllers\Back;

use App\Models\pagesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
class PagesController extends Controller
{
    public function index(){
        $pages =pagesModel::orderBy('id','DESC')->get();

        return view('back.pages.index',compact('pages'));
    }

    public function create(){
        return view('back.pages.create');
    }


    public function store(Request $request)
    {

        $rules = [
            'title'=>'min:4',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validate = Validator::make($request->all(),$rules);

        if($validate->fails()){
            return redirect()->route('admin.sayfalar.create')->withErrors($validate)->withInput();
        }
        $last = pagesModel::orderBy('order','DESC')->first();

        $page = new pagesModel();
        $page->title = $request->title;
        $page->order= $last->order+1;
        $page->content = $request->contentt;
        $page->slug = str_slug($request->title);

        if($request->hasFile('image')){
            $imgName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imgName);
            $page->image='uploads/'.$imgName;
        }
        $page->save();

        return redirect()->route('admin.sayfalar.index');
    }


    public function update($id){
        $page = pagesModel::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }

    public function updatePost(Request $request,$id){

        $rules = [
            'title'=>'min:4',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validate = Validator::make($request->all(),$rules);

        if($validate->fails()){
            return redirect()->route('admin.sayfalar.create')->withErrors($validate)->withInput();
        }

        $page = pagesModel::findOrFail($id);
        $page->title = $request->title;
        $page->content = $request->contentt;
        $page->slug = str_slug($request->title);

        if($request->hasFile('image')){
            $imgName = str_slug($request->title).".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imgName);
            $page->image='uploads/'.$imgName;
        }
        $page->save();

        return redirect()->route('admin.sayfalar.index');
    }


    public function delete($id){
        pagesModel::findOrFail($id)->delete();
        return redirect()->route('admin.sayfalar.index');
    }


    public function orders(Request $request){
      print_r($request->get('orders'));
      $data = $request->get('orders');
      foreach($data as $order){
          pagesModel::update(['order'=>$order])->where('id',$order);
      }
    }

}

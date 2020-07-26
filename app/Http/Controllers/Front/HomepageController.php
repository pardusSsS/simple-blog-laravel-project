<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\contactModel;
use App\Models\pagesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Validator;
use function foo\func;
use function Sodium\increment;
use Mail;
use App\Models\Config;


class HomepageController extends Controller
{



    public function __construct(){//==>bu fonksiyon içerisindeki yazılan kodu bu controllerdaki tüm fonksiyonlarla paylaşır ve bizi kod tekrarından kurtarır
        if(Config::find(1)->active==0){
            return redirect()->to('site-bakimda')->send();
        }
       view()->share('pages',pagesModel::orderBy('order','ASC')->get());//==>hepsinde var
       view()->share('categories',CategoryModel::inRandomOrder()->get());//==>page hariç hepsinde var
    }

    public function index(){

        $data['articles']=Article::where('status',1)->orderBy('created_at','DESC')->paginate(2);
        $data['articles']->withPath(url( 'sayfa'));
        return view('front.homepage',$data);
    }



    public function single($category,$slug){
        $category=CategoryModel::whereSlug($category)->first() ;
        if(!$category){abort(403,'Böyle Bir  Yazı Bulunamadı');}

        $article=Article::whereSlug($slug)->whereCategoryId($category->id)->first();
        if(!$article){abort(403,'Böyle Bir Yazı Bulunamadı');}


        $article->increment('hit');
        $data['articel']=$article;

        return view('front.single',$data);
    }

public function category($slug){
        $category = CategoryModel::whereSlug($slug)->first();
        if(!$category){abort(403,'Böylr Bir Kategori Bulunamadı');}
        $data['category']=$category;
        $data['articles']=Article::where('category_id',$category->id)->orderBy('created_at','DESC')->paginate(1);

    return view('front.category',$data);

}



public function page($slug){

            $page = pagesModel::whereSlug($slug)->first();
            if(!$page){
                abort(403,'Böyle bir sayfa bulunamadı');
            }

            $data['page']=$page;
            return view('front.page',$data);

    }


    public function iletisim(){

        return view('front.contact');
    }

    public function iletisimpost(Request $request)
    {

        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10'
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->route('iletisim')->withErrors($validate)->withInput();
        }

        Mail::send([], [], function ($message) use ($request) {
            $message->from('omeraksit0550@gmail.com', 'Blog Sitesi');
            $message->to('omeraksit0550@gmail.com');
            $message->setBody('Mesajı Gönderen: ' . $request->name . '<br/>
                                Mesajı Gönderen Mail: ' . $request->email . '<br/>
                                 Mesaj Konusu: ' . $request->topic . '<br/>
                                 Mesaj:' . $request->message);
                                //tarihi ekle
            $message->subject($request->name . 'iletişimden mesaj gönderdi');

        });

    }


//----------------------------------------------------------------------------------------------------





















    /* public function single($category,$slug){


        $articel = Article::whereSlug($slug)->first();//where yanındaki slug veri tabanındakini temsil etmektedir


     /*  if( CategoryModel::whereSlug($category)->first() ) {
            abort(403, 'Böyle bir yazı bulunamadı');//sorrrrrrrrrrrrrrrrrrrrrrrr
        }*/


       /* if(!$articel){
            abort(403,'Böyle bir yazı bulunamadı');
        }



        $articel->increment('hit');

        $data['articel'] = $articel;
        $data['categories']=CategoryModel::inRandomOrder()->get();
        return view('front.single',$data);
    }*/

}

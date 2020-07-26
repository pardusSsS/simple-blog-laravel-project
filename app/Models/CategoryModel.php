<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $guarded = ['id'];

    public function articelCount(){

        return $this->hasMany('App\Models\Article','category_id','id')->count();
                                    //bağlanacağımız model/bağlanacağımız id/bağlanacak id

    }
}

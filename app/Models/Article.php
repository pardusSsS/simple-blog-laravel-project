<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Phalcon\Mvc\Model;
class Article extends Model
{
    use SoftDeletes;

    protected $table = 'articles';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    function getCategory(){
      return  $this->hasOne('App\Models\CategoryModel','id','category_id');
    }
}

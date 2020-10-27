<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    //

    protected $guarded=[];

    public function categories(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function setTitleAttribute($value){
        $this->attributes['slug']=Str::slug($value);
        $this->attributes['title']=$value;
    }

}

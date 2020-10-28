<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use SoftDeletes;

    protected $guarded=[];

    public function setTitleAttribute($value){
        $this->attributes['title']=ucfirst($value);
        $this->attributes['slug']=Str::slug($value);
    }
}

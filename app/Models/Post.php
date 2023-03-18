<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'amount'];
    // protected $table = "posts"; //in case the name of the table does not follow the plural conventions
    // protected $primariKey = "post_id"; //In case the PK is different than "id"

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function photos(){
        return $this->morphMany('App\Models\Photo','imageable');
    }

    public function tags(){
        return $this->morphToMany('App\Models\Tag','taggable');
    }
}

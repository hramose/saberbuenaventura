<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    protected $fillable = ['source', 'author', 'year', 'link'];

    public function questions(){
    	return $this->hasMany('App\Question');
    }
}

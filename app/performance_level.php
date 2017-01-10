<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Performance_level extends Model
{
    protected $table = 'performance_level';


    protected $fillable = ['level', 'description', 'min_score', 'max_score','area_id'];

    public function area(){
    	return $this->belongsTo('App\Area');
    }
}

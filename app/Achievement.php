<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievements';

    protected $fillanle = ['name', 'competence_id'];

    public function competence(){
    	return $this->belongsTo('App\Competence');
    }
}

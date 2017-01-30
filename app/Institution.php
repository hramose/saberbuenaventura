<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Student;
use App\Class_room;
use App\Pre_icfes;

class Institution extends Authenticatable
{
    protected $table = 'institutions';

    protected $cast = [
    	'rol'   =>  'institution'
    ];

    protected $fillable = ['name', 'street_address', 'phone', 'email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function class_rooms(){
    	return $this->hasMany('App\Class_room');
    }

    public static function getStudent($id_institution){
        return Student::select('students.*')
                ->join('class_rooms', 'students.class_room_id', '=', 'class_rooms.id')
                ->join('institutions', 'class_rooms.institution_id', '=', 'institutions.id')
                ->where('institutions.id', '=', $id_institution)
                ->orderBy('id', 'DES')->paginate(3);
    }

    public static function getClassrooms($id_institution){
        return Class_room::select('*')
                ->where('institution_id','=', $id_institution)
                ->orderBy('id', 'DES')->paginate(5);   
    } 

    public static function getClassroomsList($id_institution){
        return Class_room::select('*')
                ->where('institution_id','=', $id_institution)
                ->orderBy('id', 'DES')
                ->lists('name', 'id');   
    }   

    public static function getPreicfes($id_institution){
        return Pre_icfes::select('pre_icfes.*')
                ->join('class_rooms', 'pre_icfes.class_room_id', '=', 'class_rooms.id')
                ->join('institutions', 'class_rooms.institution_id', '=', 'institutions.id')
                ->where('institutions.id', '=', $id_institution)
                ->orderBy('id', 'DES')->paginate(5);
    }
}

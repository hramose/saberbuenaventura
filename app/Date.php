<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{	
	public $months = [
		1	=>	'Enero',
		2	=>	'Febrero',
		3	=>	'Marzo',
		4	=>	'Abril',
		5	=>	'Mayo',
		6	=>	'Junio',
		7	=>	'Julio',
		8	=>	'Agosto',
		9	=>	'Septiembre',
		10	=>	'Octubre',
		11	=>	'Noviembre',
		12	=>	'Diciembre'
	];

	public $day;
	public $month;
	public $year;

    function __construct(){

    }

    public function setDate($date){
    	$temp_date = explode('-', $date);
    	$this->day = $temp_date[0];
    	$this->month = $this->months[$temp_date[1]];
    	$this->year = $temp_date[2];
    }

    public function getFullDate(){
    	return $this->day.' de '.$this->month.' del '.$this->year;
    }

    public function getMonths(){

    	return $this->months;
    }

    public function getDay(){
    	return $this->day;
    }

    public function getMonth(){
    	return $this->month;
    }

    public function getYear(){
    	return $this->year;
    }

    public function getActualyDay(){
        return date("d");
    }

    public function getActualyMonth(){
         $month_tmp = date('m');

        if(substr($month_tmp,0,1) == 0)
            return $this->months[substr($month_tmp,1,2)];
        else
            return date('m');
    }

    public function getActualyYear(){
        return date("Y");
    }
}

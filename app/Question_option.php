<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Question;
use DB;

class Question_option extends Model
{
    protected $table = 'question_options';

    protected $fillable = ['option', 'option_type', 'value', 'question_id'];

    public function question(){
    	return $this->belongsTo('App\Question');
    }

    public function student_pre_icfes_questions(){
    	return $this->hasMany('App\Student_pre_icfes_questions');
    }

    public static function saveOption(Request $request){
    	$question                       = new Question();
        $question->fill($request->all());
        $question->save();

        foreach ($request->option as $key => $value) {
            $boolean = false;

            if($key == $request->value[0]) $boolean = true;

            if($request->option_type == 'image'){
            	$file = $request->file('option')[$key];
            	$name = 'sb_img_'.$key.'_'.time().'.'.$file->getClientOriginalExtension();
            	$path = public_path().'/img/options/';
            	$file->move($path, $name);
            	$value = $name;
	        }

	        DB::table('question_options')->insert([
	            'option'        =>  $value,
	            'option_type'   =>  $request->option_type,
	            'value'         =>  $boolean,
	            'question_id'   =>  $question->id,
	            'created_at'    =>  date('Y-m-d H:m:i'),
	            'updated_at'    =>  date('Y-m-d H:m:i')
	        ]);
        }
    }

    public static function updateOption(Request $request, $question_id){
        $question   = Question::find($question_id);
        $question->fill($request->all());
        $question->save();
        

        $cont = 0;
        foreach($request->option as $key => $option){
            $boolean = false;

            if($request->value[0] == $cont++) $boolean = true;

            if($request->option_type == 'image'){

                if($request->file('option')[$key] != null){
                    
                    $Q_option = Question_option::find($key);
                    unlink(public_path().'/img/options/'.$Q_option->option);

                    $file = $request->file('option')[$key];
                    $option = 'sb_img_'.$key.'_'.time().'.'.$file->getClientOriginalExtension();
                    $path = public_path().'/img/options/';
                    $file->move($path, $option);
                }else{
                    $Q_option = Question_option::find($key);
                    $option = $Q_option->option;
                }    
            }
            

            DB::table('question_options')
                ->where('id', $key)
                ->update([
                    'option'        =>  $option,
                    'option_type'   =>  $request->option_type,
                    'value'         =>  $boolean,
                    'question_id'   =>  $question->id,
                    'created_at'    =>  date('Y-m-d H:m:i'),
                    'updated_at'    =>  date('Y-m-d H:m:i')
                ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Area;
use App\Achievement;
use App\Competence;
use App\Http\Requests\AchievementRequest;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achievements = Achievement::orderBy('id','DES')->paginate(6);

        $achievements->each(function($achievements){
            $achievements->competence->area;
        });

        return view('admin.partials.achievement.index')
               ->with('achievements', $achievements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::orderBy('id','DES')->lists('name', 'id');
        return view('admin.partials.achievement.create')
               ->with('areas', $areas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AchievementRequest $request)
    {

        for ($i=0; $i < count($request->name); $i++) { 
            DB::table('achievements')->insert([
                [
                    'name'=> $request->name[$i], 
                    'competence_id'=> $request->competence_id, 
                    'created_at' => date('Y-m-d H:m:i'),
                    'updated_at' => date('Y-m-d H:m:i')
                ]
            ]);
        }

        flash('El logro se ha creado correctamente', 'success');
        return redirect()->route('admin.achievement.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $achievement = Achievement::find($id);
        $areas = Area::orderBy('id','DES')->lists('name', 'id');
        $competences = Competence::orderBy('id','DES')->lists('name', 'id');

        return view('admin.partials.achievement.edit')
               ->with('achievement', $achievement)
               ->with('areas', $areas)
               ->with('competences', $competences);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AchievementRequest $request, $id)
    {
        $achievement = Achievement::find($id);
        $achievement->fill($request->all());
        $achievement->save();

        flash('El logro <b>'.$achievement->name.'</b>se ha editado correctamente', 'success');
        return redirect()->route('admin.achievement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $achievement = Achievement::find($id);
        $achievement->delete();

        flash('El logro <b>'.$achievement->name.'</b> se ha eliminado correctamente', 'success');
        return redirect()->route('admin.achievement.index');
    }
}

<?php

namespace App\Http\Controllers\Cars;

use Illuminate\Http\Request;
use App\car_models;
use App\cars;
use App\Http\Controllers\Controller;

class carmodelscontroller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {}

    public function indexview()
    {
        $cars = car_models::all();
        $models = cars::all();
        return view('cars', compact('cars', 'models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new car_models();
        $model->model_id = $request->input('model');
        $model->color = $request->input('color');
        $model->year = $request->input('year');
        $model->boardnumber = $request->input('board');
        $model->status = 1;
        $model->save();
        return json_encode($model);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = car_models::find($id);
        if(isset($id)){
            return json_encode($model);
        }
        return response('Modelo Invalido', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = car_models::find($id);
        if(isset($id)){
            $model->model_id = $request->input('model');
            $model->color = $request->input('color');
            $model->year = $request->input('year');
            $model->boardnumber = $request->input('board');
            $model->status = 1;
            $model->save();
            return json_encode($model);
        }
        return response('Modelo Invalido', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cars = car_models::find($id);
        if(isset($id)){
            $cars->delete();
        }
    }
}

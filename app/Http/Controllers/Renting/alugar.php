<?php

namespace App\Http\Controllers\Renting;

use Illuminate\Http\Request;
use App\car_models;
use App\cars;
use App\clients;
use App\car_rents;
use App\Http\Controllers\Controller;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Auth;

class alugar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexview()
    {
        $cars = car_models::all();
        $models = cars::all();
        $clients = clients::all();
        return view('alugar', compact('cars', 'models', 'clients'));
    }
    
    
    public function index()
    {
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new car_rents;
        $model->client = Auth::id();
        $model->car = $request->input('model');
        $model->locationdate = $request->input('locationdate');
        $model->devolutiondate = $request->input('devolutiondate');
        $model->rentvalue = $request->input('rentvalue');
        $model->status = 1;
        $model->save();
        
        $car = car_models::find($model->car);
        $car->status = 0;
        $car->save();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

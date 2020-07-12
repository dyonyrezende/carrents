<?php

namespace App\Http\Controllers\CarModels;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\cars;
use App\car_models;
use App\Http\Controllers\Controller;

class carscontroller extends Controller
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
            $models = cars::all();
            return view('modelos', compact('models'));
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
        $request->validate([
            'model' => 'required'
        ]);

        $car = new cars();
        $car->model = $request->input('model');
        $car->save();
        return json_encode($car);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cars = cars::find($id);
        if (isset($cars)) {
            
            return json_encode($cars);
        }
        return response('Modelo n�o identificado', 404);
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cars = cars::find($id);
        if (isset($cars)) {
            $cars->model = $request->input('model');
            $cars->save();
        return json_encode($cars);
        }
        
        return response('Modelo n�o identificado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cars = cars::find($id);
        
        if(isset($cars)){
        $cars->delete();
        }
       
        
    }
}

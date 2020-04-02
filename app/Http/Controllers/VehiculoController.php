<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VehiculoFormRequest;
use DB;




class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  /*  public function index()
    {

        
      $vehiculos=Vehiculo::orderBy('id','DESC')->paginate(3);
 return view('Vehiculo.index',compact('vehiculos')); 
    }

    */


    public function index(Request $request)
    
    
    { if ($request)
        
        { 
            $query=trim($request->get('searchText')); 
            $vehiculos=DB::table('vehiculos')->where('placa','LIKE','%'.$query.'%') ->orderBy('id','desc') ->paginate(5); 
            return view('Vehiculo.index',["vehiculos"=>$vehiculos,"searchText"=>$query]); 
        } 
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('Vehiculo.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (VehiculoFormRequest $request)
    {
        $vehiculo=new Vehiculo;
        $vehiculo->placa=$request->get('placa');
        $vehiculo->tipo=$request->get('tipo');
        $vehiculo->modelo=$request->get('modelo');
        $vehiculo->save();
        return Redirect::to('vehiculo');

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
        Vehiculo::find($id)->delete();
        return redirect()->route('vehiculo.index')->with('success','Registro Eliminado'); 
    }
}

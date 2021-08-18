<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $datos['servicios']=Servicios::paginate(10);

        return view('servicios.index',$datos);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$datosServicio=request()->all();

        $datosServicio=request()->except('_token');
       
        if($request->hasFile('foto')){
            $datosServicio['foto']=$request->file('foto')->store('uploads','public');
    }
    Servicios::insert( $datosServicio);
    //return response()->json($datosServicio);
    return redirect('servicios')->with('Mensaje','Servicio registrado con éxito');
     }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function show(Servicios $servicios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $servicio= Servicios::findOrFail($id); // recepciona la informacion que nos envian a travez de la url y busca a todos los empleado o empleados que tengan ese id ($Nombre)
        return view ('servicios.edit', compact('servicio'));// lo que esta haciendo es enviar la informacion del empleado a travez del retorno de la vista
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosServicio=request()->except(['_token','_method']);

        if($request->hasFile('foto')){
            $servicio= Servicios::findOrFail($id);
            Storage::delete('public/'.$servicio->foto);

            $datosServicio['foto']=$request->file('foto')->store('uploads','public');
    }



        Servicios::where('id','=',$id)->update($datosServicio);
        // $servicio= Servicios::findOrFail($id); // recepciona la informacion que nos envian a travez de la url y busca a todos los empleado o empleados que tengan ese id ($Nombre)
        //return view ('servicios.edit', compact('servicio'));
        return redirect('servicios')->with('Mensaje','Servicio modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $servicio=Servicios::findOrFail($id);//va a buscar los registros anteriores por que lo esta poniendo ante de hacer la actualizacion 
        if(Storage::delete('public/'.$servicio->foto)){
            Servicios::destroy($id);
    }
        
    return redirect('servicios')->with('Mensaje','Servicio eliminado');
    }
    
}

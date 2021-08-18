<?php

namespace App\Http\Controllers;

use App\Service;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $profile = Profile::where("user_id", "=", \Auth::user()->id)->first();
        $search = $request->get('buscar');
        if($profile == null) {
            $user = \Auth::user();
            return redirect('profile/create')->with('message', 'Primero debe registrar su perfil');
        }
        $services = Service::where("profile_id", "=", $profile->id)->search($search)->paginate(6);

        return view('services.index', [
            "services" => $services,
            "busqueda" => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = [
            'title'=> 'required|string|max:100',
            'description'=> 'string',
            'price'=> 'required|regex:/^[0-9]+(\.[0-9]{1,3})?$/',
            'picture_path'=>'max:10000|mimes:jpeg,png,jpg'
        ];
        $message = ["required"=>' :attribute es requerido' ];

        $this->validate($request, $fields, $message);
        // $serviceData=request()->all();

        $serviceData = request()->except('_token');
        $profile = Profile::where("user_id", "=", \Auth::user()->id)->first();
        $serviceData['profile_id'] = $profile->id;

        if($request->hasFile('picture_path')){
            $serviceData['picture_path'] = $request->file('picture_path')->store('uploads','public');
        }


        Service::insert( $serviceData);
        //return response()->json($daserviceData
        return redirect('service')->with('message','Servicio registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view ('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $fields = [
            'title'=> 'required|string|max:100',
            'description'=> 'string',
            'price'=> 'required|regex:/^[0-9]+(\.[0-9]{1,3})?$/',
            'picture_path'=>'max:10000|mimes:jpeg,png,jpg'
        ];

        if($request->hasFile('picture_path')){

            $fields += ['picture_path'=>'max:10000|mimes:jpeg,png,jpg'];

        }

        $message = ["required"=>' :attribute es requerido' ];

        $this->validate($request, $fields, $message);

        $dataService = request()->except(['_token','_method']);


        if($request->hasFile('picture_path')){

            Storage::delete('public/'.$service->picture_path);

            $service->picture_path = $request->file('picture_path')->store('uploads','public');

        }

        $service->update($dataService);

        return redirect('service')->with('message','Servicio editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if(Storage::delete('public/'.$service->picture_path)){
            $service->delete();
        }
        return redirect('service')->with('message','Servicio borrado con éxito');
    }
}

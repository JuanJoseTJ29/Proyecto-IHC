<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;
use App\Profile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->get('buscar');
        $services = Service::search($search)->paginate(10);

        return view('home', [
            "services" => $services,
            "busqueda" => $search
        ]);
    }
}

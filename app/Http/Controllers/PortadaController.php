<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;

class PortadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::take(6)->get();

        return view('welcome', compact('services'));
    }

}

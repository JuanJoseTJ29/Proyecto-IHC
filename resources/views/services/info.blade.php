@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<style>
    .fondo{
        background-color: #00aa66;
        color: white;
    } 
    h1, h2{
        font-weight: bold;
        font-style: oblique;
        font-family: 'Pacifico', cursive;
        font-size: 40px;
    }
    h2{
        font-size: 30px;
    }
    .foto{
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
        margin: auto;
        margin-bottom: 20px;
    }
</style>

    <div class="container fondo">
        <div class="row justify-content-md-center text-center">
            <div class="col-4">
                <h1>¿Quienes somos?</h1>
            </div>
        </div>
        <div class="row justify-content-sm-center text-center">
            <div class="col-8">
                <p>Somos un grupo de estudiantes de la Universidad Nacional Mayor de San Marcos dede la facultad de Ingeniería de Sistemas e informática de la escuela de Ingeniería de Software quienes hemos decido desarrollar esta página web para poder ayudar en estos tiempos de pandemia a las micro, pequeñas, medianas empresas y trabajadores independientes a poder ofrecer sus servicios y generarles un mayor rango de clientes. A su vez también buscamos ayudar a que las personas que deseen adquirir un servicio no se expongan al salir en búsqueda de uno, sino que lo averigüen o lo soliciten por medio de nuestra página web. 
                    <br>  Gracias el equipo SERVICE HOME STORE.</p>   
            </div>
        </div>
    </div>
  
@endsection 
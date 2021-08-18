@extends('adminlte::page')

@section('title', 'Cambio de informacion')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Servicio</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('service.index') }}">Servicio</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Editar Servicio
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
<section class="content">
</section>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Ficha del Servicio</h3>
                </div>
                <form action="{{ route('service.update', $service) }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="card-body">
                        @include('services.form')
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-between">
                            <input type="submit" class="btn btn-primary" value="Editar">

                            <a class="btn btn-outline-secondary" href="{{route('service.index')}}">Regresar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop






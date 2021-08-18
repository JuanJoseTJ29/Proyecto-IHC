
@extends('layouts.app')

@section('content')

<form action="{{url('/servicios')}}" class="form-horinzontal" method="post" enctype="multipart/form-data">
{{csrf_field()}}
@include('servicios.form',['Modo'=>'crear'])

</form>
</div>
@endsection
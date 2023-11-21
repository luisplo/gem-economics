@extends('layouts.app')
@section('content')
    <div>
        <h1 class="flex justify-center pb-8 text-4xl font-semibold">Listado de actividades</h1>
        <p class="flex justify-center text-center">El módulo proporciona una visión general de todas las actividades
            registradas en el sistema. La lista presenta de manera clara y concisa cada actividad, mostrando detalles clave
            como el nombre, la descripción, las gemas asignadas, el intervalo y la frecuencia. Esta funcionalidad facilita
            la revisión y la supervisión de todas las actividades, permitiendo a los usuarios obtener información rápida
            sobre el estado y los detalles de cada tarea planificada.</p>
        <br>
        @includeIf('layouts.list', ['id' => 'activity_id','module' => 'activities', 'title' => 'actividad'])
    </div>
@endsection

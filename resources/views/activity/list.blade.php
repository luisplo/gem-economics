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
        <div class="flex justify-end py-5">
            <a class="btn" href="/activities/create">Registrar actividad</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Gemas</th>
                    <th>Intervalo</th>
                    <th>Frecuencia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $key => $activity)
                    <tr class="hover">
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->value }}</td>
                        <td>{{ $activity->intervals->name }}</td>
                        <td>{{ $activity->frequency }}</td>
                        <td class="grid grid-cols-2">
                            <form method="get" action="{{ route('activities.complete', $activity->id) }}">
                                @csrf
                                <button type="submit" class="btn bg-success"
                                    onclick="return confirm('¿Estás seguro de que deseas dar por finalizada la actividad?')">
                                    Completada
                                </button>
                            </form>
                            <form method="post" action="{{ route('activities.destroy', $activity->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-error"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar la actividad?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

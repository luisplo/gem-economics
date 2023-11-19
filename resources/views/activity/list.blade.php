@extends('layouts.app')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Gemas</th>
                <th>Intervalo</th>
                <th>Frecuencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Models\Activity::with('intervals')->get() as $key => $activity)
                <tr class="hover">
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $activity->name }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ $activity->value }}</td>
                    <td>{{ $activity->intervals->name }}</td>
                    <td>{{ $activity->frequency }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@extends('layouts.app')
@section('content')
    <div>
        <h1 class="flex justify-center pb-8 text-4xl font-semibold">Listado de recompensas</h1>
        <p class="flex justify-center text-center">El módulo de recompensas ofrece un listado completo de todas las
            recompensas registradas en el sistema. Cada entrada en la lista presenta de manera clara y concisa detalles
            clave, incluyendo el nombre de la recompensa, su descripción, y cualquier información adicional relevante. Este
            diseño facilita la revisión y supervisión eficientes de todas las recompensas, permitiendo a los usuarios
            obtener información rápida sobre cada elemento registrado en el sistema.</p>
        <br>
        <div class="flex justify-end py-5">
            <a class="btn" href="/rewards/create">Registrar recompensa</a>
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
                @foreach ($rewards as $key => $reward)
                    <tr class="hover">
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $reward->name }}</td>
                        <td>{{ $reward->description }}</td>
                        <td>{{ $reward->value }}</td>
                        <td>{{ $reward->intervals->name }}</td>
                        <td>{{ $reward->frequency }}</td>
                        <td>
                            <form method="post" action="{{ route('rewards.destroy', $reward->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar la recompensa?')">
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

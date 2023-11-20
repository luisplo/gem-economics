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
        @includeIf('layouts.list', ['module' => 'rewards', 'title' => 'recompensa'])
    </div>
@endsection

<div>
    <div class="flex justify-end py-5">
        <a class="btn" href="/{{ $module }}/create">Registrar {{ $title }}</a>
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
            @foreach ($data as $key => $item)
                <tr class="hover" disabled>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->value }}</td>
                    <td>{{ $item->intervals->name }}</td>
                    <td>{{ $item->frequency }}</td>
                    <td class="grid grid-cols-2">
                        <form method="post" action="{{ route($module . '.complete') }}">
                            @csrf
                            <input name="{{ $id }}" hidden value={{ $item->id }}>
                            <input name="value" hidden value={{ $item->value }}>
                            <button type="submit" class="btn bg-success {{ $item->disabled ? 'btn-disabled' : '' }}"
                                onclick="return confirm('¿Estás seguro de que deseas dar por finalizada la {{ $title }}?')">
                                Completada
                            </button>
                        </form>
                        <form method="post" action="{{ route($module . '.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-error"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar la {{ $title }}?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

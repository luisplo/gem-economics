<div class="navbar shadow">
    <div class="flex-1">
        <a href="/" class="btn btn-ghost text-xl">{{ config('app.name') }}</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/activities/list">Actividades</a></li>
            <li><a href="/rewards/list">Recompensas</a></li>
            {{-- <li>
                <details>
                    <summary>
                        Parent
                    </summary>
                    <ul class="p-2 bg-base-100">
                        <li><a>Link 1</a></li>
                        <li><a>Link 2</a></li>
                    </ul>
                </details>
            </li> --}}
        </ul>
    </div>
</div>

@extends('layouts.app')
@section('content')
    <div class="w-full text-center">
        <h1 class="text-4xl font-semibold pb-8">Estadisticas</h1>
        <div class="stats shadow ">
            <div class="stat place-items-center">
                <div class="stat-title">Gemas usadas</div>
                <div class="stat-value">{{ number_format($stats_activities['used_values']) }}</div>
            </div>
            <div class="stat place-items-center">
                <div class="stat-title">Total de gemas disponibles</div>
                <div class="stat-value text-success">{{ number_format($stats_activities['values']) }}</div>
            </div>
            <div class="stat place-items-center">
                <div class="stat-title">Gemas por penalizaciones</div>
                <div class="stat-value text-error">0</div>
            </div>
        </div>
        <br>
        <div class="stats shadow mt-5">
            <div class="stat place-items-center">
                <div class="stat-title">Actividades completadas</div>
                <div class="stat-value text-success">{{ number_format($stats_activities['complete_activities']) }}</div>
            </div>
            <div class="stat place-items-center">
                <div class="stat-title">Actividades por completar</div>
                <div class="stat-value text-warning">{{ number_format($stats_activities['incomplete_activities']) }}</div>
            </div>
        </div>
        <br>
        <div class="stats shadow mt-5">
            <div class="stat place-items-center">
                <div class="stat-title">Recompensas completadas</div>
                <div class="stat-value ">{{ number_format($stats_rewards['complete_rewards']) }}</div>
            </div>
            <div class="stat place-items-center">
                <div class="stat-title">Recompensas por completar</div>
                <div class="stat-value text-success">{{ number_format($stats_rewards['incomplete_rewards']) }}</div>

            </div>
        </div>
        <br>
        <div class="stats shadow mt-5">
            <div class="stat place-items-center">
                <div class="stat-title">Total de penalizaciones</div>
                <div class="stat-value text-error">0</div>
            </div>
        </div>
    </div>
@endsection

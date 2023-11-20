@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('activities.store') }}">
        @csrf
        @include('layouts.create', ['title' => 'actividad'])
    </form>
@endsection

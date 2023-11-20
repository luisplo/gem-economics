@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('rewards.store') }}">
        @csrf
        @include('layouts.create', ['title' => 'recompensas'])
    </form>
@endsection

@extends('layouts.app-master')

@section('content')

    <h1 class='container'>Home</h1>

    @auth
    <p>Bienvenido {{auth()->user()->name ?? auth()->user()->email}},estás autenticado a la página</p>
    <p><a href="/logout">Logout</a></p>
    @endauth

    @guest
    <p>Para ver el contenido <a href ="/login">Inicia sesión </a></p>
    @endguest


@endsection


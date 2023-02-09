@extends('layouts.register-master')

@section('content')

    <form action="/register" method="POST">
        @csrf
        <h1>Registro</h1>
        @include('layouts.partials.messages')
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
        </div>


        <button type="submit" class="btn btn-primary">Crear cuenta</button>
        <div> </div>
        <div class="">
            <a style="font-size:12px;" href="/login">Iniciar sesión</a>
        </div>
      </form>

@endsection

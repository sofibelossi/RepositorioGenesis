@extends('layout')
@section('contenido')
@php
    $sortField = $sortField ?? 'id';
    $sortDirection = $sortDirection ?? 'asc';
    $buscar = $buscar ?? '';
@endphp
@guest
            <a href="{{ route('login') }}">Iniciar sesión</a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-light">Cerrar sesión</button>
            </form>
        @endauth
        
         @if (session('status'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center mt-3" role="alert">
        {{ session('error') }}
    </div>
@endif
<h1>Index</h1>
<a href="{{ route('medicamentos.create') }}">Nuevo</a>
<div class="col-6">
    <form action="{{ route('buscar') }}" method="GET">
        <div class="row">
            <div class="col-6">
            <input type="text" name="buscar" placeholder="Buscar por tipo o laboratorio" class="form-control">
            </div>
            <div class="col-6">
            <button type="submit">Buscar</button>
            </div>
        </div>
</form>
</div> <br>
<table class="table table-warning table-striped mt-4">
<thead>
    <tr>
        <th scope="col">
            <a href="?sort=id&direction={{ $sortField === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    Id
                    @if($sortField === 'id')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a>
        </th>
        <th scope="col">nombre</th>
        <th scope="col">precio</th>
        <th scope="col">laboratorio</th>
        <th scope="col">tipo</th>
        <th scope="col">imagen</th>
        <th scope="col">acciones</th>
    </tr>
</thead>
<tbody>
    @foreach($medicamentos as $medicamento)
    <tr>
        <td>{{$medicamento->id}}</td>
        <td>{{$medicamento->nombre}}</td>
        <td>{{$medicamento->precio}}</td>
        <td>{{$medicamento->laboratorio}}</td>
        <td>{{$medicamento->tipo}}</td>
        <td><img src="{{asset('imagenes/'.$medicamento->imagen)}}" width="100px" heigth="100 px" ></td>
        <td>
            <form action="{{route ('medicamentos.destroy',$medicamento->id)}}" method="post">
            <a href="/medicamentos/{{$medicamento->id}}/edit" class="btn btn-secondary">Editar</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection
@extends('layout')
@section('contenido')

@php
    $sortField = $sortField ?? 'id';
    $sortDirection = $sortDirection ?? 'asc';
    $buscar = $buscar ?? '';
@endphp
@guest
<style>
.mensaje-flotante {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
}

.mensaje-exito, .mensaje-error {
    margin: 0;
    padding: 10px 15px;
    border-radius: 8px;
    color: #fff;
    font-weight: 500;
    min-width: 200px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    opacity: 0.95;
}

.mensaje-exito {
    background-color: #28a745;
}

.mensaje-error {
    background-color: #dc3545;
}


.mensaje-exito, .mensaje-error {
    animation: fadeOut 4s ease forwards;
}

@keyframes fadeOut {
    0% { opacity: 1; transform: translateY(0); }
    80% { opacity: 1; }
    100% { opacity: 0; transform: translateY(-10px); }
}
</style>
<br>
            <a href="{{ route('login') }}" class="btn" style="background-color: #9dbfaf;">Iniciar sesión</a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn" style="background-color: #9dbfaf;">Cerrar sesión</button>
            </form>
        @endauth
        
        @if (session('status') || session('error'))
    <div class="mensaje-flotante">
        @if (session('status'))
            <p class="mensaje-exito">{{ session('status') }}</p>
        @endif

        @if (session('error'))
            <p class="mensaje-error">{{ session('error') }}</p>
        @endif
    </div>
@endif
<br>
<center>
<h1>Listado de medicamentos</h1>
</center>
<a href="{{ route('medicamentos.create') }}" class="btn" style="border radius: 6px; background-color: #9dbfaf;">Nuevo medicamento</a>
<div class="col-6">
    <br>
    <form action="{{ route('buscar') }}" method="GET">
        <div class="row">
            <div class="col-6">
            <input type="text" name="buscar" placeholder="Buscar por tipo o laboratorio" class="form-control">
            </div>
            <div class="col-6">
            <button type="submit" class="btn" style="border radius: 6px; background-color: #00ccbe;">Buscar</button>
            
            </div>
        </div>
</form>
</div> <br>
<table class="table table-secondary table-striped mt-4">
<thead>
    <tr>
        <th scope="col">
            <a href="?sort=id&direction={{ $sortField === 'id' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    id
                    @if($sortField === 'id')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a>
        </th>
        <th scope="col">
            <a href="?sort=nombre&direction={{ $sortField === 'nombre' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    nombre
                    @if($sortField === 'nombre')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a>
            </th>
        <th scope="col">
            <a href="?sort=precio&direction={{ $sortField === 'precio' && $sortDirection === 'asc' ? 'desc' : 'asc' }}">
                    precio
                    @if($sortField === 'precio')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </a>
        </th>
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
@extends('layout')
@section('contenido')
<center>
    <br>
<h1>Iniciar sesión</h1>
<div>
<form action="{{route ('login')}}" method="post">
@csrf
<div class="col-3"></div>
 <div class="col-6">
 <label class="form-label">Email</label>
<input type="email" name="email" value="{{ old('email') }}" class="form-control">
 @error('email')</div>
 <div class="col-3"></div>

 <div class="col-3"></div>
  <div class="col-6">
    <small class="font-bold text-danger">{{ $message }}</small>
 @enderror</div>
 <div class="col-3"></div>

 <div class="col-3"></div>
 <div class="col-6">
 <label class="form-label">Contraseña</label>
<input type="password" name="password" class="form-control">
 @error('password')</div>
 <div class="col-3"></div>


    <small class="font-bold text-danger">{{ $message }}</small>
 @enderror
 
 <br>
 <button type="submit" class="btn" style="background-color: #00ccbe;">Iniciar sesión</button>
 <a href="/register" class="btn" style="background-color: #00ccbe;">Registrarse</a>
</form>
</div>
</center>
@endsection
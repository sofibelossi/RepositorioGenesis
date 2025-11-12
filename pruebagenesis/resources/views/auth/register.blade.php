@extends('layout')
@section('contenido')
<center>
    <br>
<h1>Registro de usuario</h1>
<div>
<form action="{{route ('register')}}" method="post">
@csrf

<div class="col-3"></div>
<div class="col-6">
<label class="form-label">Nombre</label>
<input type="text" name="name" value="{{ old('name') }}" class="form-control">
 @error('name')
   <small class="font-bold text-danger">{{ $message }}</small>
 @enderror</div>
 <div class="col-3"></div>

<div class="col-3"></div>
<div class="col-6">
 <label class="form-label">Email</label>
<input type="email" name="email" value="{{ old('email') }}" class="form-control">
 @error('email')
    <small class="font-bold text-danger">{{ $message }}</small>
 @enderror</div>
 <div class="col-3"></div>

<div class="col-3"></div>
<div class="col-6">
 <label class="form-label">Contraseña</label>
<input type="password" name="password" class="form-control">
 @error('password')
    <small class="font-bold text-danger">{{ $message }}</small>
 @enderror</div>
 <div class="col-3"></div>

<div class="col-3"></div>
<div class="col-6">
 <label class="form-label">Confirmar contraseña</label>
<input type="password" name="password_confirmation" value="{{ old('email') }}" class="form-control">
 @error('password_confirmation')
    <small class="font-bold text-danger">{{ $message }}</small>
 @enderror</div>
 <div class="col-3"></div>


 <button type="submit" class="btn mt-3" style="background-color: #00ccbe;">Registrar</button>

</form>
</div>
</center>
@endsection
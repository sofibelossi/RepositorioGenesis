
<br><center>
<h2>{{ $medicamento->exists ? 'Editar medicamento' : 'Agregar medicamento'}}</h2>


<form action="{{$medicamento->exists ? route ('medicamentos.update', $medicamento->id) : route('medicamentos.store')}}" method="post" enctype="multipart/form-data">
    @csrf
   @if($medicamento->exists)
      @method ('PUT')
    @endif
    <div class="col-3"></div>
  <div class="col-6 mb-3">
    <label for="" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $medicamento->nombre) }}">
     @error('nombre')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="col-3"></div>

  <div class="col-3"></div>
  <div class="col-6 mb-3">
    <label for="" class="form-label">Precio</label>
    <input type="text" class="form-control" name="precio" value="{{ old('precio', $medicamento->precio) }}">
     @error('precio')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="col-3"></div>

  <div class="col-3"></div>
  <div class="col-6 mb-3">
    <label for="" class="form-label">Laboratorio</label>
    <input type="text" class="form-control" name="laboratorio" value="{{ old('laboratorio', $medicamento->laboratorio) }}">
     @error('laboratorio')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
<div class="col-3"></div>

<div class="col-3"></div>
  <div class="col-6 mb-3">
    <label for="" class="form-label">Tipo</label>
    <input type="text" class="form-control" name="tipo" value="{{ old('tipo', $medicamento->tipo) }}">
     @error('tipo')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
@if($medicamento->exists && $medicamento->imagen)
<div class="col-3"></div>

<div class="col-3"></div>
  <div class="col-6 mb-3">
    <label for="" class="form-label">Imagen</label> <br>
    <img src="{{ asset('imagenes/'.$medicamento->imagen) }}" alt="imagen actual" heigth="100px" width="100px">  
     @error('imagen')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
@endif
<div class="col-3"></div>

<div class="col-3"></div>
<div class="col-6 mb-3">
    <label for="imagen" class="form-label">Nueva Imagen</label>
    <input type="file" class="form-control" name="imagen">
  </div>
  <div class="col-3"></div>

  <button type="submit" class="btn btn-primary">{{ $medicamento->exists ? 'Editar' : 'Guardar'}}</button>
</center>
</form>


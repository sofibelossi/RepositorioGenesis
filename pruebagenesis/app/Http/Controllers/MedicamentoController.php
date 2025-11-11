<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Http\Requests\MedicamentoRequest;
class MedicamentoController extends Controller
{
    /**kururin
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index(Request $request)
{
    // Leer parámetros GET (?sort=campo&direction=asc)
    $sortField = $request->input('sort', 'id');
    $sortDirection = $request->input('direction', 'asc');

    // Validar que los campos sean válidos (previene SQL injection)
    $allowedFields = ['id', 'nombre', 'precio', 'laboratorio', 'tipo'];
    if (!in_array($sortField, $allowedFields)) {
        $sortField = 'id';
    }

    $sortDirection = $sortDirection === 'desc' ? 'desc' : 'asc';

    // Traer los registros ordenados
    $medicamentos = Medicamento::orderBy($sortField, $sortDirection)->get();

    // Devolver vista con los datos
    return view('Medicamento.Medicamentos', [
        'medicamentos' => $medicamentos,
        'sortField' => $sortField,
        'sortDirection' => $sortDirection,
        'buscar' => '',
    ]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $medicamento = new Medicamento();
    return view('Medicamento.create', compact('medicamento'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicamentoRequest $request)
    {
        $medicamentos=new Medicamento();
        $medicamentos->nombre=$request->get('nombre');
        $medicamentos->precio=$request->get('precio');
        $medicamentos->laboratorio=$request->get('laboratorio');
        $medicamentos->tipo=$request->get('tipo');
        
        
          if ($request->hasFile('imagen')) {
        $archivo = $request->file('imagen');
        $nombre = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('imagenes'), $nombre); // lo guarda en /public/imagenes
        $medicamentos->imagen = $nombre;
    }
        $medicamentos->save();//se usa eloquent
        return redirect('/medicamentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicamento=Medicamento::find($id);
        return view('Medicamento.edit')->with('medicamento',$medicamento); //'medicamento' puede que tnga q cambiarlo jisdvdsgz
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedicamentoRequest $request, $id)
    {
        $medicamento = Medicamento::find($id);
        $medicamento->nombre=$request->get('nombre');
        $medicamento->precio=$request->get('precio');
        $medicamento->laboratorio=$request->get('laboratorio');
        $medicamento->tipo=$request->get('tipo');  
         if ($request->hasFile('imagen')) {
        // Eliminar la imagen antigua (si existe)
        if ($medicamento->imagen && file_exists(public_path('imagenes/'.$medicamento->imagen))) {
            unlink(public_path('imagenes/'.$medicamento->imagen));  // Elimina la imagen vieja
        }

        // Subir la nueva imagen
        $archivo = $request->file('imagen');
        $nombre = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('imagenes'), $nombre);

        // Guardar el nombre de la nueva imagen
        $medicamento->imagen = $nombre;
    }     
        $medicamento->save();//se usa eloquent
        return redirect('/medicamentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $medicamento = Medicamento::find($id);
       $medicamento->delete();//se usa eloquent
       return redirect('/medicamentos')->with('status', 'Medicamento eliminado con éxito');
    }
     public function buscar(Request $request)
{
    
    $query = $request->input('buscar');
    $sortField = $request->input('sort', 'id'); 
    $sortDirection = $request->input('direction', 'asc'); 

 
    $medicamentos = Medicamento::query();

    // filtra por marca laboratorio
    if (!empty($query)) {
        $medicamentos->where(function($q) use ($query) {
            $q->where('tipo', 'LIKE', "%{$query}%")
              ->orWhere('laboratorio', 'LIKE', "%{$query}%");
        });
    }

    //ordenamiento
    $medicamentos = $medicamentos->orderBy($sortField, $sortDirection)->get();

    
    return view('medicamento.medicamentos', [
        'medicamentos' => $medicamentos,
        'sortField' => $sortField,
        'sortDirection' => $sortDirection,
        'buscar' => $query,
    ]);
}
}

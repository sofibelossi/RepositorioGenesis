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
    public function index()
    {
         $medicamentos=Medicamento::all();
        return view('Medicamento.Medicamentos')->with('medicamentos',$medicamentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Medicamento.create');
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
       return redirect('/medicamentos');
    }
}

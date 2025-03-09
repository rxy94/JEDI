<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Edificio;
use App\Rules\CodigoPostalValido;
use Illuminate\Http\Request;

class EdificioController extends Controller
{

    /**
     * Muestra un listado de edificios
     *
     * @return void
     */
    public function listar()
    {
        //$edificios = Edificio::all();
        $edificios = Edificio::paginate(8);
        return view('edificio.listar', ['edificios' => $edificios]);
    }

    /**
     * Actualiza los edificios asociados a un departamento
     *
     * @param Request $request
     * @return void
     */
    public function actualizar(Request $request, Edificio $edificio)
    {

        $request->validate([
            'numDespachos' => 'required|integer|min:0|max:5',
        ]);

        # Recuperamos el ID del departamento desde el formulario
        $idDep = $request->input('idDep');
        $numDespachos = $request->input('numDespachos');

        # Verificamos si el número de despachos supera el límite
        $totalDespachos = $edificio->departamentos->sum('pivot.despacho');
        $nuevoTotalDespachos = $totalDespachos - $edificio->departamentos->find($idDep)->pivot->despacho + $numDespachos;

        if ($nuevoTotalDespachos > 5) {
            # No se realiza la actualización y volvemos a la vista de gestión de edificios del dept
            return $this->mostrarDatos($idDep); 

        }

        # Actualizamos el número de despachos en la tabla pivot
        if($numDespachos != 0) {
            $edificio->departamentos()->updateExistingPivot($idDep, [
                'despacho' => $numDespachos,
            ]);

        } else {
            # Si es 0, llamos a borrar para desasociar el edificio del dept
            $this->borrar($request, $edificio);

        }

        return $this->mostrarDatos($idDep);

    }

    /**
     * Muestra los edificios asociados a un dept
     *
     * @param Request $request
     * @param Edificio $edificio
     * @return void
     */
    public function mostrarDatos($idDep)
    {
        # Recuperamos los datos del departamento actualizado
        $departamento = Departamento::find($idDep);

        # Recuperamos los edificios asociados al departamento con los datos de la tabla pivot
        $edificios = $departamento->edificios;

        # Calculamos el total de despachos para cada edificio
        $edificios->each(function ($edificio) {
            $edificio->totalDespachos = $edificio->departamentos->sum('pivot.despacho');
        });

        return view('departamento.edificios', [
            'departamento' => $departamento,
            'edificios' => $edificios,
        ]);

    }

    /**
     * Desasocia un departamento del un edificio
     *
     * @param Request $request
     * @param Edificio $edificio
     * @return void
     */
    public function borrar(Request $request, Edificio $edificio)
    {

        # Recuperamos los datos del departamento
        $idDep = $request->input('idDep');

        # Eliminamos la relación entre el edificio y el departamento en la tabla pivot
        $edificio->departamentos()->detach($idDep);

        # Recuperamos los datos del departamento
        $departamento = Departamento::find($idDep);

        # Recuperamos los datos de la tabla pivot
        $edificios = $departamento->edificios;

        return view('departamento.edificios', [
            'departamento' => $departamento, 
            'edificios' => $edificios
        ]); 

    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Edificio $edificio
     * @return void
     */
    public function borrarTodo(Edificio $edificio)
    {

        //dd($edificio);

        # Desasociamos todas las relaciones del edificio con los departamentos
        $edificio->departamentos()->detach();

        $edificio->delete();

        return to_route('edificio.listar');

    }

    /**
     * Crea un nuevo edificio
     *
     * @param Request $request
     * @return void
     */
    public function crear(Request $request)
    {

        if ($request->isMethod('GET')) {
            return view('edificio.crear');
        }

        $request->validate([
            'nombre' => 'required|string',
            'calle' => 'required|string',
            'numero' => 'required|integer',
            'cp' => [
                'required',
                'digits:5',
                new CodigoPostalValido(),
            ],

        ]);

        Edificio::create([
            'nombre' => $request->input('nombre'),
            'calle' => $request->input('calle'),
            'numero' => $request->input('numero'),
            'cp' => $request->input('cp'),

        ]);

        return to_route('edificio.listar');

    }

    /**
     * Modifica los datos de un edificio
     *
     * @param Request $request
     * @param Edificio $edificio
     * @return void
     */
    public function editar(Request $request, Edificio $edificio)
    {

        if ($request->isMethod('GET')) {
            return view('edificio.editar', ['edificio' => $edificio]);
        }

        $request->validate([
            'nombre' => 'required|string',
            'calle' => 'required|string',
            'numero' => 'required|integer',
            'cp' => [
                'required',
                'digits:5',
                new CodigoPostalValido(),
            ],

        ]);

        $edificio->update([
            'nombre' => $request->input('nombre'),
            'calle' => $request->input('calle'),
            'numero' => $request->input('numero'),
            'cp' => $request->input('cp'),

        ]);

        return to_route('edificio.listar');

    }


}

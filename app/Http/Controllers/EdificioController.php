<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{

    /**
     * Undocumented function
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

        # Actualizamos el número de despachos en la tabla pivot
        if($numDespachos != 0) {
            $edificio->departamentos()->updateExistingPivot($idDep, [
                'despacho' => $request->input('numDespachos'),
            ]);

        } else {
            $this->borrar($request, $edificio);

        }

        # Recuperamos los datos del departamento actualizado
        $departamento = Departamento::find($idDep);

        # Recuperamos los datos de la tabla pivot
        $edificios = $departamento->edificios()->withPivot('despacho')->get();

        return view('departamento.edificios', ['departamento' => $departamento, 'edificios' => $edificios]); 

    }

    /**
     * Undocumented function
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
        $edificios = $departamento->edificios()->withPivot('despacho')->get();

        return view('departamento.edificios', ['departamento' => $departamento, 'edificios' => $edificios]); 

    }

}

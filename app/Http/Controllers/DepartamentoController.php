<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{

    /**
     * Muestra todos los departamentos
     *
     * @return void
     */
    public function listar()
    {
        $departamentos = Departamento::all();

        return view('dashboard', ['departamentos' => $departamentos]);

    }

    /**
     * Muestra una vista según un value
     *
     * @param Request $request
     * @return void
     */
    public function mostrar(Request $request)
    {

        $value = $request->input('departamentos');

        # Mostramos el formulario de crear departamento si el value == 'crear'
        if ($value == 'crear') {
            return view('dashboard');
        }

        $departamento = Departamento::find($value);
        //$edificios = $departamento->edificios;
        $edificios = $departamento->edificios()->withPivot('despacho')->get();
        //dd($despachos);
        //dd($edificios);

        return view('departamento.edificios', ['departamento' => $departamento, 'edificios' => $edificios]);
        
    }

    /**
     * Valida los campos de un formulario
     *
     * @param Request $request
     * @return void
     */
    public function validar(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string',
        ]);

        $departamento = Departamento::create([
            'nombre' => $request->input('nombre'),
        ]);

        return to_route('departamento.edificios', ['idDep' => $departamento->idDep]);

    }
    

}

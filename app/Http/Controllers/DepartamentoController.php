<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Edificio;
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
     * Muestra una vista según un value obtenido de la vista
     *
     * @param Request $request
     * @return void
     */
    public function mostrar(Request $request)
    {

        $value = $request->input('departamentos');

        # Mostramos el formulario de crear departamento en el Home
        if ($value == 'crear') {
            return view('dashboard');
        }

        # Recupero la info del departamento enviado desde la vista
        $departamento = Departamento::find($value);

        # Recupero el número de despachos de ese departamento
        $edificios = $departamento->edificios;

        # Calculamos el total de despachos para cada edificio
        $edificios->each(function ($edificio) {
            $edificio->totalDespachos = $edificio->departamentos->sum('pivot.despacho');
        });

        return view('departamento.edificios', [
            'departamento' => $departamento, 
            'edificios' => $edificios
        ]);
        
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

        # Recupero los despachos del departamento nuevo
        $edificios = $departamento->edificios;

        return view('departamento.edificios', [
            'departamento' => $departamento, 
            'edificios' => $edificios
        ]);

    }

    /**
     * Muestra la vista asociar edificio para un departamento
     *
     * @param Request $request
     * @param Departamento $departamento
     * @return void
     */
    public function mostrarAsociarEdificio(Departamento $departamento)
    {

        # Recuperamos los edificios que no están asociados al departamento
        $edificiosNoAsociados = Edificio::whereDoesntHave('departamentos', function ($query) use ($departamento) {
            $query->where('departamento_edificio.idDep', $departamento->idDep);
        })->get();

        # Calculamos el número total de despachos para cada edificio
        $edificiosNoAsociados->each(function ($edificio) {
            $edificio->totalDespachos = $edificio->departamentos->sum('pivot.despacho');
        });

        return view('departamento.asociar', [
            'departamento' => $departamento,
            'edificios' => $edificiosNoAsociados,
        ]);

    }

    /**
     * Asocia un número de despachos de un edificio a un departamento
     *
     * @param Request $request
     * @param Departamento $departamento
     * @return void
     */
    public function asociarEdificio(Request $request, Departamento $departamento)
    {
        //dd($departamento);

        $idEdi = $request->input('idEdi');
        $numDespachos = $request->input('numDespachos');

        # Asociamos el edificio al departamento con el número de despachos especificado
        $departamento->edificios()->attach($idEdi, ['despacho' => $numDespachos]);

        return to_route('edificio.mostrarDatos', ['departamento' => $departamento->idDep]);

    }
    

}

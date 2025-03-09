@extends('layouts.main')
@section('contenido')
    @parent

    <div class="flex flex-col items-center mt-10">
        <div class="mb-5">
            <h1 class="text-2xl font-semibold">Asociar edificio al departamento de {{ $departamento->nombre }}</h1>
        </div>

        <table class="table-auto w-3/5 border border-gray-700 text-center">
            <thead>
                <tr class="border-b border-gray-800 bg-gray-700">
                    <th class="py-2 text-white">Nombre del Edificio</th>
                    <th class="py-2 text-white">Dirección</th>
                    <th class="py-2 text-white">Nº Despachos</th>
                    <th class="py-2 text-white">Total Despachos Ocupados</th>
                    <th class="py-2 text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($edificios as $edificio)
                    @if ($edificio->totalDespachos < 5)
                        <tr class="border-b border-gray-800 bg-gray-50">
                            <td class="py-2">{{ $edificio->nombre }}</td>
                            <td class="py-2">{{ $edificio->calle }} {{ $edificio->numero }}, {{ $edificio->cp }}</td>
                            <td class="py-2">
                                <form action="{{ route('departamento.asociarEdificio', ['departamento' => $departamento->idDep]) }}" method="post">
                                @csrf
                                    <input 
                                        type="number" 
                                        name="numDespachos" 
                                        value="1"
                                        max="{{ 5 - $edificio->totalDespachos }}" 
                                        min="1">
                            </td>
                            <td class="py-2">{{ $edificio->totalDespachos }}</td>
                            <td class="py-2">
                                    <input type="hidden" name="idEdi" value="{{ $edificio->idEdi }}">
                                    <button type="submit" class="rounded-lg py-2 px-3 bg-blue-500 text-white hover:bg-blue-400">Asociar</button>
                                </form>
                            </td>
                        </tr>

                    @endif
                @empty
                    <tr>
                        <td colspan="4" class="py-2 bg-gray-50">No hay edificios disponibles para asociar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
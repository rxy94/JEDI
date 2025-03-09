@extends('layouts.main')
@section('contenido')
    @parent

    <div class="flex flex-col items-center mt-10">
        <div class="mb-5">
            <h1 class="text-2xl font-semibold">Gestión de Edificios del Departamento de {{$departamento->nombre}}</h1>
        </div>
        
        {{-- Tabla de edicidios asociados al departamento --}}
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
                <tr class="border-b border-gray-800 bg-gray-50">
                    <td class="py-2">{{$edificio->nombre}}</td>
                    <td class="py-2">{{$edificio->calle}} {{$edificio->numero}}, {{$edificio->cp}}</td>
                    <td class="py-2">
                        <form action="{{route('edificio.actualizar', ['edificio' => $edificio->idEdi])}}" method="post">
                            @csrf
                            @method('PUT')
                        <input 
                        name="numDespachos"
                        type="number" 
                        value="{{$edificio->pivot->despacho}}" 
                        max="5" 
                        min="0">
                    </td>
                    <td class="py-2">{{ $edificio->totalDespachos }}</td>
                    <td class=" flex gap-2 justify-center py-2">
                        {{-- Botón Actualizar --}}
                            <input type="hidden" name="idDep" value="{{$edificio->pivot->idDep}}">
                            <button class="rounded-lg py-2 px-3 bg-yellow-500 text-white hover:bg-yellow-400">Actualizar</button>
                        </form>
                        {{-- Botón Eliminar --}}
                        <form action="{{ route('edificio.borrar', ['edificio' => $edificio->idEdi]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="idDep" value="{{ $departamento->idDep }}">
                            <button class="rounded-lg py-2 px-3 bg-red-500 text-white hover:bg-red-400">Borrar</button>
                        </form>
                    </td>
                </tr>
  
                @empty
                    <tr>
                        <td colspan="5" class="py-4 bg-gray-50">No hay edificios asociados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Opciones --}}
        <div class="mt-8">
            <a 
                href="{{ route('departamento.mostrarAsociarEdificio', ['departamento' => $departamento]) }}" 
                type="button" 
                class="rounded-lg py-2 px-3 bg-gray-700 text-white hover:bg-gray-600 mr-2">
                Asociar Edificio
            </a>
        </div>
    </div>

@endsection
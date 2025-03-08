@extends('layouts.main')
@section('contenido')
    @parent

    <div class="flex flex-col items-center mt-10">
        <div class="mb-5">
            <h1 class="text-2xl font-semibold">Gestión de Edificios del Departamento de {{$departamento->nombre}}</h1>
        </div>
        <table class="table-auto w-3/5 border border-gray-700 text-center">
            <thead>
                <tr class="border-b border-gray-800 bg-gray-700">
                    <th class="py-2 text-white">Nombre del Edificio</th>
                    <th class="py-2 text-white">Dirección</th>
                    <th class="py-2 text-white">Nº Despachos</th>
                    <th class="py-2 text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($edificios as $item)
                <tr class="border-b border-gray-800 bg-gray-50">
                    <td class="py-2">{{$item->nombre}}</td>
                    <td class="py-2">{{$item->calle}} {{$item->numero}}, {{$item->cp}}</td>
                    <td class="py-2">
                        <form action="{{route('edificio.actualizar', ['edificio' => $item->idEdi])}}" method="post">
                            @csrf
                            @method('PUT')
                        <input 
                        name="numDespachos"
                        type="number" 
                        value="{{$item->pivot->despacho}}" 
                        max="5" 
                        min="0">
                    </td>
                    <td class=" flex gap-2 justify-center py-2">
                        {{-- Botón Actualizar --}}
                            <input type="hidden" name="idDep" value="{{$item->pivot->idDep}}">
                            <button class="rounded-lg py-2 px-3 bg-yellow-500 text-white hover:bg-yellow-400">Actualizar</button>
                        </form>
                        {{-- Botón Eliminar --}}
                        <form action="{{ route('edificio.borrar', ['edificio' => $item->idEdi]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="idDep" value="{{ $departamento->idDep }}">
                            <button class="rounded-lg py-2 px-3 bg-red-500 text-white hover:bg-red-400">Borrar</button>
                        </form>
                    </td>
                </tr>
  
                @empty
                    <tr>
                        <td colspan="4" class="py-4 bg-gray-50">No hay edificios asociados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Opciones --}}
        <div>
            {{-- TODO --}}
        </div>
    </div>

@endsection
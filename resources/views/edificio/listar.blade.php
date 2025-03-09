@extends('layouts.main')
@section('contenido')
    @parent

    <div class="flex flex-col items-center mt-10 mb-10">
        <div class="mb-5">
            <h1 class="text-2xl font-semibold">
                {{__('jedi.tit_edificios')}}
            </h1>
        </div>

        {{-- botón Nuevo Edificio --}}
        <div class="self-start w-3/5 mx-auto mb-4">
            <a href="{{route('edificio.crear')}}"
                type="button" 
                class="rounded-lg py-2 px-3 bg-gray-800 text-white hover:bg-gray-700">
                {{__('jedi.btn_nuevo_edi')}}
            </a>
        </div>
        
        {{-- Tabla de edificios asociados al departamento --}}
        <table class="table-auto w-3/5 border border-gray-700 text-center">
            <thead>
                <tr class="border-b border-gray-800 bg-gray-700">
                    <th class="py-2 text-white">{{__('jedi.tab_edificio')}}</th>
                    <th class="py-2 text-white">{{__('jedi.tab_direccion')}}</th>
                    <th class="py-2 text-white">{{__('jedi.tab_cp')}}</th>
                    <th class="py-2 text-white">{{__('jedi.tab_accion')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($edificios as $edificio)
                <tr class="border-b border-gray-800 bg-gray-50">
                    <td class="py-2">{{$edificio->nombre}}</td>
                    <td class="py-2">{{$edificio->calle}}, {{$edificio->numero}}</td>
                    <td class="py-2">{{$edificio->cp}}</td>
                    {{-- Acciones --}}
                    <td class=" flex gap-2 justify-center py-2">
                        {{-- Botón Actualizar --}}
                        <a href="{{route('edificio.editar', ['edificio' => $edificio])}}" 
                            type="button" 
                            class="rounded-lg py-2 px-3 bg-yellow-500 text-white hover:bg-yellow-400">
                            {{__('jedi.btn_actualizar')}}
                        </a>
                        {{-- Botón Eliminar --}}
                        <form action="{{ route('edificio.borrarTodo', ['edificio' => $edificio->idEdi]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="rounded-lg py-2 px-3 bg-red-500 text-white hover:bg-red-400">
                                {{__('jedi.btn_borrar')}}
                            </button>
                        </form>
                    </td>
                </tr>
  
                @empty
                    <tr>
                        <td colspan="4" class="py-4 bg-gray-50">
                            No existen edificios
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- Paginación --}}
        <nav class="mt-5">
            {{ $edificios->links() }}
        </nav>
    </div>

@endsection
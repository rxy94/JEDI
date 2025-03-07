@extends('layouts.main')
@section('contenido')
    @parent

    <div class="text-center">
        <h1 class="font-semibold text-3xl pb-5 pt-14">Registrar departamento</h1>
    </div>

    <form action="{{route('departamento.validar')}}" method="post" 
          class="w-1/3 border border-gray-600 rounded-lg bg-gray-600 p-5 m-auto">
        @csrf
        
        {{-- Nombre departamento --}}
        <div class="flex flex-col text-lg">
            <label for="nombre" class="text-white py-2">
                Nombre del departamento
            </label>
            <input type="text" 
                    name="nombre" 
                    id="nombre"
                    placeholder="Nombre del departamento"
                    class="border border-gray-200 rounded-lg py-2">
        </div>

        {{-- Botón --}}
        <div class="flex m-auto w-2/5 mt-5">
            <button class="border border-gray-700 rounded-lg bg-gray-800 text-gray-200 w-full px-10 py-2 mr-2 hover:bg-gray-700">Guardar</button>
            <a type="button"
                href="{{route('dashboard')}}" 
                class="border border-gray-700 rounded-lg bg-gray-800 text-gray-200 w-full px-10 py-2 hover:bg-gray-700">Cancelar</a>
        </div> 

    </form>
    
@endsection
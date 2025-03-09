@extends('layouts.main')
@section('contenido')
    @parent

    <div class="flex flex-col items-center mt-10 mb-10">
        <div class="mb-5">
            <h1 class="text-2xl font-semibold">Crear Nuevo Edificio</h1>
        </div>

        {{-- Formulario para crear un nuevo edificio --}}
        <div class="w-2/5 mx-auto mb-4">
            <form action="{{ route('edificio.crear') }}" method="POST">
                @csrf
                {{-- campo nombre --}}
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-semibold">Nombre del Edificio</label>
                    <input type="text" name="nombre" id="nombre" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                @error('nombre')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                {{-- campo calle --}}
                <div class="mb-4">
                    <label for="calle" class="block text-gray-700 font-semibold">Calle</label>
                    <input type="text" name="calle" id="calle" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                @error('calle')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                {{-- campo numero --}}
                <div class="mb-4">
                    <label for="numero" class="block text-gray-700 font-semibold">Número</label>
                    <input type="text" name="numero" id="numero" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                @error('numero')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                {{-- campo cp --}}
                <div class="mb-4">
                    <label for="cp" class="block text-gray-700 font-semibold">Código Postal</label>
                    <input type="text" name="cp" id="cp" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                @error('cp')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                {{-- Acciones --}}
                <div class="flex justify-end">
                    <button type="submit" class="rounded-lg py-2 px-3 mr-2 bg-gray-700 text-white hover:bg-gray-600">Guardar</button>
                    <a href="{{route('edificio.listar')}}" class="rounded-lg py-2 px-3 bg-red-600 text-white hover:bg-red-500">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

@endsection
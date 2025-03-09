@extends('layouts.main')
@section('contenido')
    @parent

    <div class="flex flex-col items-center mt-10 mb-10">
        <div class="mb-5">
            <h1 class="text-2xl font-semibold">
                @lang('jedi.tit_crear_edi')
            </h1>
        </div>

        {{-- Formulario para crear un nuevo edificio --}}
        <div class="w-2/5 mx-auto mb-4">
            <form action="{{ route('edificio.crear') }}" method="POST">
                @csrf
                {{-- campo nombre --}}
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-semibold">
                        @lang('jedi.lbl_nom_edificio')
                    </label>
                    <input type="text" name="nombre" id="nombre" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                @error('nombre')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                {{-- campo calle --}}
                <div class="mb-4">
                    <label for="calle" class="block text-gray-700 font-semibold">
                        @lang('jedi.lbl_calle')
                    </label>
                    <input type="text" name="calle" id="calle" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                @error('calle')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                {{-- campo numero --}}
                <div class="mb-4">
                    <label for="numero" class="block text-gray-700 font-semibold">
                        @lang('jedi.lbl_numero')
                    </label>
                    <input type="text" name="numero" id="numero" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                @error('numero')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                {{-- campo cp --}}
                <div class="mb-4">
                    <label for="cp" class="block text-gray-700 font-semibold">
                        @lang('jedi.lbl_cp')
                    </label>
                    <input type="text" name="cp" id="cp" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                @error('cp')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                {{-- Acciones --}}
                <div class="flex justify-end">
                    <button type="submit" class="rounded-lg py-2 px-3 mr-2 bg-gray-700 text-white hover:bg-gray-600">
                        @lang('jedi.btn_guardar')
                    </button>
                    <a href="{{route('edificio.listar')}}" class="rounded-lg py-2 px-3 bg-red-600 text-white hover:bg-red-500">
                        @lang('jedi.btn_cancelar')
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
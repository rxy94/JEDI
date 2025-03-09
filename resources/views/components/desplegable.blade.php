<div class="w-2/5 m-auto mt-8">
    <form action="{{route('departamento.mostrar')}}" method="post">
        @csrf
    
        <div>
            <label id="listbox-label" class="block text-2xl font-semibold text-gray-900 text-center mb-5">
                @lang('jedi.tit_dept')
            </label>
            {{-- Select de departamentos --}}
            <div class="flex gap-3 mt-2">
                <select name="departamentos" class="z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-2 text-base text-center ring-1 shadow-lg ring-black/5 focus:outline-hidden sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                    <option class="relative cursor-default py-3 pr-9 pl-3 text-gray-900 text-md select-none" id="listbox-option-0" role="option" disabled>
                            -- Listado de departamentos
                    </option>
        
                    @forelse ($departamentos as $key => $dept)
                        <option value="{{$key + 1}}" class="cursor-default py-3 pr-9 pl-3 text-gray-900 text-md select-none" id="listbox-option-0" role="option">
                            {{$key + 1}} - {{$dept->nombre}}
                        </option>
                    @empty
                        <p>No existen departamentos</p>
                    @endforelse
                    {{-- Opción otro --}}
                    <option value="crear" class="m-auto w-2/5">
                        Otro...
                    </option>
                </select>
                
                {{-- Botón Aceptar --}}
                <div class="m-auto w-2/5 mt-1">
                    <button class="border border-gray-700 rounded-lg bg-gray-800 text-gray-200 w-full px-10 py-2">
                        @lang('jedi.btn_aceptar')
                    </button>
                </div> 
            </div>
            
        </div>
    </form>

    {{-- Componente Crear Departamento --}}
    @if(request()->input('departamentos') == 'crear')
        <x-crear-departamento /> 
    @endif

</div> 

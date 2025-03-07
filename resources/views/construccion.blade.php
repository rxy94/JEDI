@extends('layouts.main')
@section('contenido')

    <div class="flex flex-col">
        <div>
            <h1 class="text-5xl text-gray-800 text-center mt-10">EN CONSTRUCCIÓN...</h1>
        </div>
        <div class="m-auto mt-5">
            <img src="https://fastly.picsum.photos/id/831/800/500.jpg?hmac=8tE5lv8ag2xMXbD7D1i94hY14k_hIFmsmWSeaSnEpUc" alt="imagen random">
        </div>
        <div class="border border-gray-500 rounded-lg bg-gray-900 p-3 text-gray-100 text-center w-2/5 m-auto mt-5 hover:bg-gray-700">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button>Volver al Login</button>
            </form>
        </div>
    </div>
    
@endsection
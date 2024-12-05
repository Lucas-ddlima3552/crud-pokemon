@extends('layouts.base')

@section('content')

<div class="container">
        <form class="max-w-sm mx-auto"  action="{{ url(path: 'pokemon/' . $pokemon->id) }}"method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="mb-5 mx-auto">
                <label for="nome" class="block mb-2 text-sm font-medium text-white" style="margin-top: 150px;">Nome do Pokémon:</label>
                <input type="text" name="nome" id="nome" value="{{ $pokemon->nome }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div class="mb-5">
                <label for="tipo" class="block mb-2 text-sm font-medium text-white">Tipo:</label>
                <input type="text" name="tipo" id="tipo" value="{{ $pokemon->tipo }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"required>
            </div>
            <div class="mb-5">
                <label for="pontos_de_poder" class="block mb-2 text-sm font-medium text-white">Poder:</label>
                <input type="text" name="pontos_de_poder" id="pontos_de_poder" value="{{ $pokemon->pontos_de_poder }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"required>
            </div>
            <div class="mb-5">
                <img src="{{asset($pokemon->image)}}" alt="">
                <label for="image" class="block mb-2 text-sm font-medium text-white">Imagem</label>
                <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="mb-5">
                <label for="coach_id" class="block mb-2 text-sm font-medium text-white">Coach:</label>
                <select name="coach_id" id="coach_id">
                    <option value="">Selecione um treinador:</option>
                    @foreach ($coaches as $coach)
                        <option value="{{$coach->id}}">{{$coach->nome}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Editar Pokémon</button>
        </form>
    </div>

@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
        public function index()
    {
        $pokemon = Pokemon::all();
        return view('pokemon.index', compact('pokemon'));
    }

    public function create()
    {
        $coaches = Coach::all();
        return view('pokemon.create', compact('coaches'));
    }

    public function store(Request $request)
    {   
        $request->validate([
            'nome'=>'required',
            'tipo'=>'required',
            'pontos_de_poder'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gifmwebp|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $pokemon = new Pokemon();
        $pokemon->nome = $request->nome;
        $pokemon->tipo = $request->tipo;
        $pokemon->pontos_de_poder = $request->pontos_de_poder;
        $pokemon->image = 'images/'.$imageName;
        $pokemon->coach_id = $request->coach_id;
        $pokemon->save();

        return redirect('pokemon')->with('success', 'pokemon created successfully.');
    }

    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $coaches = Coach::all();
        return view('pokemon.edit', compact('pokemon', 'coaches'));
    }

    public function update(Request $request, $id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $pokemon->update($request->all());

        $pokemon->nome = $request->nome;
        $pokemon->tipo = $request->tipo;
        $pokemon->pontos_de_poder = $request->pontos_de_poder;
        
        if(!is_null($request->image))
        {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $pokemon->image = 'images/'.$imageName;
        }
        $pokemon->save();
        
        return redirect('pokemon')->with('success', 'Pokémon updated successfully.');
    }

    public function destroy($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $pokemon->delete();
        return redirect('pokemon')->with('success', 'Pokémon deleted successfully.');
    }
}

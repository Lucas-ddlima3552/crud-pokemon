<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::all();
        return view('coaches.index', compact('coaches'));
    }

    public function create()
    {
        return view('coaches.create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'nome'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gifmwebp|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $coach = new Coach();
        $coach->nome = $request->nome;
        $coach->image = 'images/'.$imageName;
        $coach->save();

        return redirect('coaches')->with('success', 'treinador created successfully.');
    }

    public function edit($id)
    {
        $coach = Coach::findOrFail($id);
        return view('coaches.edit', compact('coach'));
    }

    public function update(Request $request, $id)
    {
        $coach = Coach::findOrFail($id);
        $coach->update($request->all());

        $coach->nome = $request->nome;
        
        if(!is_null($request->image))
        {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $coach->image = 'images/'.$imageName;
        }
        $coach->save();
        
        return redirect('coaches')->with('success', 'coaches updated successfully.');
    }

    public function destroy($id)
    {
        $coach = Coach::findOrFail($id);
        $coach->delete();
        return redirect('coaches')->with('success', 'coaches deleted successfully.');
    }
}

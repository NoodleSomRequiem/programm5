<?php
namespace App\Http\Controllers;
use App\Models\Mods;
use Illuminate\Http\Request;

class ModsController extends Controller
{
    public function index()
    {
        $mods = Mods::all();
        return view('mods.index', compact('mods'));
    }

    public function create()
    {
        return view('mods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        Mods::create($request->except('_token'));

        return redirect()->route('mods.index')
            ->with('success', 'Mods created successfully');
    }

    public function show(Mods $mod)
    {
        return view('mods.show', compact('mod'));
    }

    public function edit(Mods $mod)
    {
        return view('mods.edit', compact('mod'));
    }

    public function update(Request $request, Mods $mod)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $mod->update($request->except('_token'));

        return redirect()->route('mods.index')
            ->with('success', 'Mod updated successfully');
    }

    public function destroy(Mods $mod)
    {
        $mod->delete();

        return redirect()->route('mods.index')
            ->with('success', 'Mods deleted successfully');
    }
}


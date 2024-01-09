<?php
namespace App\Http\Controllers;
use App\Models\Mods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FavoriteCount;
use App\Models\User;

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
    public function toggleFavorite(Mods $mod)
    {
        $user = Auth::user();

        if ($user) {
            if ($user->favoriteMods->contains($mod)) {
                $user->favoriteMods()->detach($mod);
            } else {
                $user->favoriteMods()->attach($mod);
                // Update favorite count
                $this->updateFavoriteCount($mod, $user); // Correct order of arguments
                // Update user role and send notification if required
                $user->updateRoleIfRequired();
            }

            // Count the number of favorites for the mod after the toggle
            $favoriteCount = FavoriteCount::where('mod_id', $mod->id)->count();

            return redirect()->route('mods.show', $mod->id)
                ->with('success', 'Favorite status updated successfully')
                ->with('isFavorited', $user->favoriteMods->contains($mod)) // Pass isFavorited to the view
                ->with('favoriteCount', $favoriteCount); // Pass favoriteCount to the view
        } else {
            return redirect()->route('mods.show', $mod->id)
                ->with('error', 'You need to be logged in to favorite a mod.');
        }
    }

    protected function updateFavoriteCount(Mods $mod, User $user)
    {
        $favoriteCount = FavoriteCount::firstOrNew(['mod_id' => $mod->id, 'user_id' => $user->id]);
        $favoriteCount->mod_id = $mod->id; // Add this line to set the mod_id
        $favoriteCount->count = $user->favoriteMods->count();
        $favoriteCount->save();
    }


    protected function getFavoriteCount(Mods $mod)
    {
        return FavoriteCount::where('mod_id', $mod->id)->value('count');
    }

}


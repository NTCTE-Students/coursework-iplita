<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewsController extends Controller
{
    public function index()
    {
        return view('index', [
            'recipes' => Recipe::all()

        ]);
    }

    public function register()
    {
        return view("pages.register");
    }

    public function login()
    {
        return view("pages.login");
    }

    public function favorites()
    {
        $user = User::find(Auth::id());
        $favorites = $user->favorites;
        return view("pages.favorites", [
            'favorites' => $favorites
        ]);
    }

    public function add_recipe()
    {
        return view("pages.add_recipe");
    }

    public function recipe(Recipe $id)
    {
        return view("pages.recipe", [
            'recipe' => $id,
            'reviews' => $id->reviews
        ]);
    }

    public function my_recipes()
    {
        $user = Auth::user();
        $recipes = Recipe::where('user_id', $user->id)->get();
        return view('pages.my_recipes', compact('recipes'));
    }

    public function show($param = null)
    {
        if($param) {
            if($param == 'up') {
                $recipes = Recipe::orderBy('created_at', 'desc')->get();
            } else {
                $recipes = Recipe::orderBy('created_at', 'asc')->get();
            }
            return view('index', compact('recipes'));
        } else {
            $recipes = Recipe::orderBy('id', 'desc')->get();

            return view('index', compact('recipes'));
        }
    }
}


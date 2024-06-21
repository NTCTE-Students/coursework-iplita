<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Favorite;

class ActionsController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|min:8|alpha_dash|confirmed',
        ], [
            'user.name.required' => 'Поле "Имя" обязательно для заполнения',
            'user.email.reqired' => 'Поле "Электронная почта" обязательно для заполнения',
            'user.email.email'=> 'Поле "Электронная почта" должно быть предоставлено в виде валидного адреса электронной почты',
            'user.password.required'=> 'Поле "Пароль" обязательно для заполнения',
            'user.password.min'=> 'Поле "Пароль" должно быть не менее, чем 8 символов',
            'user.password.alpha_dash'=> 'Поле "Пароль" должно содержать только строчные и прописные символы латиницы, цифры, а также символы "-" и "_"',
            'user.password.confirmed'=> 'Поле "Пароль" и "Повторите пароль" не совпадает',
        ]);

        $userData = $request->input('user');
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        Auth::login($user);
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user.email'=> 'required|email',
            'user.password'=> 'required|min:8|alpha_dash',
        ], [
            'user.email.reqired' => 'Поле "Электронная почта" обязательно для заполнения',
            'user.email.email'=> 'Поле "Электронная почта" должно быть предоставлено в виде валидного адреса электронной почты',
            'user.password.required'=> 'Поле "Пароль" обязательно для заполнения',
            'user.password.min'=> 'Поле "Пароль" должно быть не менее, чем 8 символов',
            'user.password.alpha_dash'=> 'Поле "Пароль" должно содержать только строчные и прописные символы латиницы, цифры, а также символы "-" и "_"',
        ]);
        if(Auth::attempt($request -> input('user'))) {
            return redirect('/');
        } else {
            return back() -> withErrors([
                'user.email' => 'Предоставленная почта или пароль не подходят'
            ]);
        }
    }

    public function add_recipe(Request $request)
    {
        $request->validate([
            'recipe.name' => 'required',
            'recipe.description' => 'required',
        ], [
            'recipe.name.required' => 'Поле "Название" обязательно для заполнения',
            'recipe.description.required' => 'Поле "Описание" обязательно для заполнения',
        ]);

        $recipeData = $request->input('recipe');
        $recipeData['user_id'] = Auth::id();
        $recipe = Recipe::create($recipeData);
        return redirect('/recipe/' . $recipe->id);
    }

    public function favorite(Request $request, Recipe $id)
    {
        $recipe = Favorite::where('user_id', Auth::id())->where('recipe_id', $id->id);
        if($recipe->exists()) {
            $recipe->delete();
        }
        else
        {
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->recipe_id = $id->id;
            $favorite->save();
        }
        return back();
    }

    public function review(Request $request, Recipe $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'rating.required' => 'Поле "Рейтинг" обязательно для заполнения',
            'rating.integer' => 'Поле "Рейтинг" должно быть предоставлено в виде целого числа',
            'rating.min' => 'Поле "Рейтинг" должно быть не менее 1',
            'rating.max' => 'Поле "Рейтинг" должно быть не более 5',
        ]);

        $review = new Review();
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->recipe_id = $id->id;
        $review->user_id = Auth::id();
        $review->save();
        return back();
    }
}

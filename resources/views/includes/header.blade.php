<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-iBB6C72M6h70gZB1lQQ7J+9/4M6lB4gZpFtvD/8+7Z/D4Uvd4yDf3Hg5K0/5fJL6" crossorigin="anonymous">


</head>
<body>
    <div class="container d-flex justify-content-center p-2 bd-highlight">
        <nav class="navbar navbar-expand-lg navbar-light bg-success text-white ">
            <a class="navbar-brand text-white  " href="{{ route('index') }}">Главная</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav " >
                    @auth
                        <li class="nav-item">
                            <a class="navbar-brand text-white" href="{{ route('favorites') }}">Избранное</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand text-white" href="{{ route('my_recipes') }}">Мои рецепты</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand  text-white" href="{{ route('add_recipe') }}">Добавить рецепт</a>
                        </li>
                        <li class="nav-item text-white ">
                            <a class="navbar-brand text-white" href="{{ route('logout') }}">Выход</a>
                        </li>
                    @else

                        <li class="nav-item text-white ">
                            <a class="navbar-brand text-white  " href="{{ route('register') }}">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand text-white" href="{{ route('login') }}">Вход</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif




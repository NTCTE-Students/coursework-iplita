@include('includes.header')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <center><h1 class="my-4">Главная</h1>
            <p class="lead">Выберите желаемый рецепт</p></center>
        </div>
        <div class="col-md-4 mb-4">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="navbar-brand text-black"  href="{{ url('/index/up') }}">Более новые</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand text-black" href="{{ url('/index/down') }}">Более старые</a>
                </li>
            </ul>
        </div>
        @foreach ($recipes as $recipe)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex-center">
                        <h2 class="card-title">{{ $recipe->name }}</h2>
                        <p class="card-text"><small class="text-muted">Автор: {{ $recipe->user->name }}</small></p>
                        <p class="card-text"><small class="text-muted">Опубликовано: {{ $recipe->created_at->format('d.m.Y H:i') }}</small></p>
                        <a href="{{ route('recipe', $recipe) }}" class="btn btn-success ">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('includes.footer')

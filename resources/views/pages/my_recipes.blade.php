@include('includes.header')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Мои рецепты</h1>
        </div>
        @foreach ($recipes as $recipe)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ $recipe->name }}</h2>
                        <p class="card-text"><small class="text-muted">Опубликовано: {{ $recipe->created_at->format('d.m.Y H:i') }}</small></p>
                        <a href="{{ route('recipe', $recipe) }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
        @if($recipes->isEmpty())
            <div class="col-md-12">
                <p>Нет избранных рецептов</p>
            </div>
        @endif
    </div>
</div>

@include('includes.footer')

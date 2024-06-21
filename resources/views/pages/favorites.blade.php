@include('includes.header')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="my-4">Избранное</h1>
        </div>
        @foreach ($favorites as $favorite)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">{{ $favorite->recipe->name }}</h2>
                        <p class="card-text"><small class="text-muted">Автор: {{ $favorite->recipe->user->name }}</small></p>
                        <p class="card-text"><small class="text-muted">Опубликовано: {{ $favorite->recipe->created_at->format('d.m.Y H:i') }}</small></p>
                        <a href="{{ route('recipe', $favorite->recipe) }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
        @if($favorites->isEmpty())
            <div class="col-md-12">
                <p>Нет избранных рецептов</p>
            </div>
        @endif
    </div>
</div>

@include('includes.footer')

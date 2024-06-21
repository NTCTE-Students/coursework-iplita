@include('includes.header')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Рецепт</div>

                <div class="card-body">
                    <h5 class="card-title">{{ $recipe->name }}</h5>
                    <p class="card-text">{{ $recipe->description }}</p>
                    <p class="card-text"><small class="text-muted">Автор: {{ $recipe->user->name }}</small></p>
                    <p class="card-text"><small class="text-muted">Опубликовано: {{ $recipe->created_at->format('d.m.Y H:i') }}</small></p>
                    <form method="POST" action="{{ route('favorite', $recipe) }}">
                        @csrf
                        <button type="submit" class="btn mt-3 bg-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="{{ $recipe->isFavorite() ? 'yellow' : 'gray' }}" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                            {{ $recipe->favorites->count() }}
                        </button>
                    </form>

                    <hr>

                    <h5 class="mt-4">Отзывы</h5>
                    @foreach($reviews as $review)
                        <div class="card mt-2">
                            <div class="card-body">
                                <h6 class="card-title">{{ $review->user->name }}</h6>
                                @if($review->comment)
                                    <p class="card-text">{{ $review->comment }}</p>
                                @else
                                    <p class="card-text">Отзыв без комментария</p>
                                @endif
                                <p class="card-text">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="{{ $i <= $review->rating ? 'yellow' : 'gray' }}" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                        </svg>
                                    @endfor
                                </p>
                                <p class="card-text"><small class="text-muted">Опубликовано: {{ $review->created_at->format('d.m.Y H:i') }}</small></p>
                            </div>
                        </div>
                    @endforeach

                    <form method="POST" action="{{ route('review.store', $recipe) }}" class="mt-4">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Оставьте отзыв:</label>
                            <textarea class="form-control" id="comment" name="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Оценка:</label>
                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                                    <label for="star{{ $i }}">{{ $i }}</label>
                                @endfor
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')

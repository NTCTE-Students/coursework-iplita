@include('includes.header')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавить рецепт</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('add_recipe') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" class="form-control" id="name" placeholder="Введите название" required name="recipe[name]">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control" id="description" placeholder="Введите описание" required name="recipe[description]"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Добавить рецепт</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
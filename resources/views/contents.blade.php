<div class="row">
    @foreach ($movies as $movie)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('poster/' . $movie->poster) }}" class="card-img-top" alt="Poster">
                <div class="card-body">
                    <h5 class="card-title">{{ $movie->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $movie->year }}</h6>
                    <p class="card-text">{{ $movie->description }}</p>
                    <a href="#" class="btn mr-2" onclick="ModalEditContent({{ $movie->id }})"><i class="fas fa-link"></i> Edit</a>
                    <a href="#" class="btn " onclick="ActionDeleteContent({{ $movie->id}})"><i class="fab fa-github"></i> Delete</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

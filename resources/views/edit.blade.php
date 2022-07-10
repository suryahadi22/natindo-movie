<form method="POST" onsubmit="ActionEditContent(event, {{ $movie->id }})">
    <!-- Modal body -->
    <div class="modal-body">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title_edit" placeholder="Enter title" value="{{ $movie->title }}">
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" class="form-control" id="year_edit" placeholder="Enter year" value="{{ $movie->year }}">
        </div>
        <div class="form-group">
            <label for="poster">Poster</label>
            <input type="file" class="form-control" id="poster_edit">
            <small>Keep empty if you don't want to change the poster</small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description_edit" rows="3">{{ $movie->description }}</textarea>
        </div>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="submit" id="submit" value="submited" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>

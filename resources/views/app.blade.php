<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <title>Natindo Movie</title>
</head>

<body>
    <div class="container mx-auto mt-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mb-3">
                    <a href="#" data-toggle="modal" data-target="#addNew" class="btn btn-primary mx-auto">New
                        Movie</a>
                </div>
            </div>
        </div>

        <div id="contents"></div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="addNew">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Movie</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="POST" onsubmit="ActionAddContent(event)">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="number" class="form-control" id="year" placeholder="Enter year">
                        </div>
                        <div class="form-group">
                            <label for="poster">Poster</label>
                            <input type="file" class="form-control" id="poster">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" id="submit" value="submited" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal" id="editMovie">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Movie</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div id="edit_content"></div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.2/umd/popper.min.js" crossorigin="anonymous"></script>

    <script>
        getContents();

        function getContents() {
            $.ajax({
                url: '{{ url('list_contents') }}',
                type: 'GET',
                success: function(data) {
                    $('#contents').html(data);
                }
            });
        }

        function ActionAddContent(event) {
            event.preventDefault();
            var formData = new FormData();

            formData.append('_token', $('#_token').val());
            formData.append('title', $('#title').val());
            formData.append('year', $('#year').val());
            formData.append('poster', $('#poster')[0].files[0]);
            formData.append('description', $('#description').val());
            $.ajax({
                url: '{{ url('ajax_new') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == 'saved') {
                        $('#title').val('');
                        $('#year').val('');
                        $('#poster').val('');
                        $('#description').val('');

                        getContents();
                        $('#addNew').modal('hide');
                    } else {
                        alert('error');
                    }
                }
            });
        }

        function ModalEditContent(id) {
            $.ajax({
                url: '{{ url('modal_edit') }}',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#edit_content').html(data);
                    $('#editMovie').modal('show');
                }
            });
        }

        function ActionEditContent(event, id_data) {
            event.preventDefault();
            var formData = new FormData();

            formData.append('_token', $('#_token').val());
            formData.append('id_data', id_data);
            formData.append('title', $('#title_edit').val());
            formData.append('year', $('#year_edit').val());
            formData.append('poster', $('#poster_edit')[0].files[0]);
            formData.append('description', $('#description_edit').val());
            $.ajax({
                url: '{{ url('ajax_edit') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == 'updated') {
                        $('#title').val('');
                        $('#year').val('');
                        $('#poster').val('');
                        $('#description').val('');

                        getContents();
                        $('#editMovie').modal('hide');
                    } else {
                        alert('error');
                    }
                }
            });
        }

        function ActionDeleteContent(id_data) {
            if (confirm('Are you sure to delete this data?')) {
                $.ajax({
                    url: '{{ url('ajax_delete') }}',
                    type: 'GET',
                    data: {
                        id_data: id_data
                    },
                    success: function(data) {
                        if (data == 'deleted') {
                            getContents();
                        } else {
                            alert('error');
                        }
                    }
                });
            }
        }
    </script>
</body>

</html>

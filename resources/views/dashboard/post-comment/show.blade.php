

    <div class="form-group">
        <label for="title">Título</label>
        <input readonly class="form-control" type="text" value="{{ $postComment->name }}">
    </div>
    <div class="form-group">
        <label for="url_clean">Usuario</label>
        <input readonly class="form-control" type="text" value="{{ $postComment->user->name }}">
    </div>
    <div class="form-group">
        <label for="content">Aprobado</label>
        <textarea readonly class="form-control" rows="3"> {{ $postComment->approved }} </textarea>
    </div>
    <div class="form-group">
        <label for="content">Contenido</label>
        <textarea readonly class="form-control" name="content" id="content" rows="3"> {{ $postComment->message }} </textarea>
    </div>



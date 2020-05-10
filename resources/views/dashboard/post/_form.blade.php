    @csrf
    <div class="form-group">
        <label for="title">Titulo</label>
        <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
        @error('title')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="url_clean">Url limpia</label>
        <input class="form-control" type="text" name="url_clean" id="url_clean" value="{{ old('url_clean', $post->url_clean) }}">
    </div>

    <div class="form-group">
        <label for="category_id">Categorías</label>
        <select name="category_id" id="category_id " class="selectpicker form-control" title="Seleccionar categoría">
            @foreach($categories as $title => $id)
                <option {{ $post->category_id == $id ? 'selected="selected"' : '' }} value="{{ $id }}">{{ $title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="posted">Posted</label>
        <select name="posted" id="posted " class="selectpicker form-control" title="Seleccionar categoría">
            @include('dashboard.partials.option-posted', ['val' => $post->posted])
        </select>
    </div>

    <div class="form-group">
        <label for="category_id">Tags</label>
        <select multiple name="tags_id[]" id="tags_id[]" class="selectpicker form-control" title="Seleccionar categoría">
            @foreach($tags as $title => $id)
                <option {{ in_array($id, old('tags_id') ?: $post->tags->pluck('id')->toArray()) ? "selected" : ""}}value="{{ $id }}">{{ $title }}</option >
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="content">Contenido</label>
        <textarea class="form-control" name="content" id="content" rows="3"> {{ old('content', $post->content) }} </textarea>
    </div>

    <input type="hidden" id="token" value="{{ csrf_token() }}">
    <input type="submit" value="Enviar" class="btn btn-primary">



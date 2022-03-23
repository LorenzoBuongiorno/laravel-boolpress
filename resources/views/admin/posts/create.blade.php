@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card dark-theme">
                <div class="card-header d-flex">
                    Aggiungi Post
                </div>

                <div class="card-body ">
                    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
          
                        {{-- titolo --}}
                        <div class="mb-3">
                          <label>Titolo</label>
                          <input type="text" name="title" class="form-control dark-theme @error('title') is-invalid @enderror"
                            placeholder="Inserisci il titolo" value="{{ old('title') }}" required>
                          @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
          
                        {{-- contenuto del post --}}
                        <div class="mb-3">
                          <label>Contenuto</label>
                          <textarea name="content" rows="10" class="form-control dark-theme @error('content') is-invalid @enderror"
                            placeholder="Inizia a scrivere qualcosa..." required>{{ old('content') }}</textarea>
                          @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        {{-- image --}}
                        <div class="mb-3">
                          <label>Image</label>
                          <input type="file" name="coverImg" class="form-control dark-theme @error('coverImg') is-invalid @enderror"
                            placeholder="Inserisci immagine">
                          @error('coverImg')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="mb-3">
                          <label>Categoria</label>
                          <select name="category_id" class="form-select dark-theme">
                            <option value="">none</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}" @if (old('category_id')=== $category->id) selected @endIf>
                                {{ $category->type }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="mb-3">
                          <label>Tags</label><br>
                          @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                id="tag_{{ $tag->id }}" name="tags[]">
                              <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                          @endforeach  
                        </div>
          
                        <div class="form-group">
                          <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Annulla</a>
                          <button type="submit" class="btn btn-success">Salva post</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
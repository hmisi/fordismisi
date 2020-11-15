@extends('layouts.app')
@section('title', 'Larahub | Edit Pertanyaan')
@section('content')
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="card-deck row m-0 justify-content-center shadow">
            <div class="card-body">
                <h3>Edit Pertanyaan.</h3>

                {{-- form --}}
                <form method="POST" action="/pertanyaan/{{$question->id}}">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="title">Judul Pertanyaan</label>
                        <input type="text" class=" @error('title') is-invalid @enderror form-control" id="title"
                            name="title" value="{{$question->title}}">
                        @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Isi Pertanyaan</label>
                        <textarea type="text" class="form-control  @error('content') is-invalid @enderror " id="content"
                            name="content">{{$question->content}}</textarea>
                        @error('content')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Tag Pertanyaan</label>
                        <textarea type="text" class="form-control @error('content') is-invalid @enderror"
                            id="tag" name="tags" placeholder="Masukan Tag Pertanyaan kamu! (Pisahkan dengan spasi)" required>{{ old('tags') ?: $question->tags->implode('name', ' ') }}</textarea>
                        @error('tags')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Pertanyaan!</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

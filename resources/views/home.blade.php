@extends('layouts.app')
@section('title', 'FORDISMISI')
@section('desc', 'Forum Diskusi tentang Pemrograman Bahasa Indonesia Oleh HMISI. Ask, Tell, and Share')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-lg-9">
            <div class="my-3 row m-0 justify-content-center">
                <div class="card-body text-center">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" >
                              <h1 class="p-3">Bertanya Menambah Wawasan</h1>
                            </div>
                          <div class="carousel-item ">
                            <h1 class="p-3">Запрашивать добавляет статистику</h1>
                          </div>
                          <div class="carousel-item">
                            <h1 class="p-3">Chiedere aggiunge approfondimenti</h1>
                          </div>
                          <div class="carousel-item">
                            <h1 class="p-3">Shitsumon wa dōsatsu o tsuika shimasu</h1>
                          </div>
                        </div>
                      </div>
                      <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Baca Aturan Forum dulu!
                    </button>
                    @if (Auth::user() == null)
                      <a href="{{route('login')}}" class="btn btn-info">Mari bertanya disini!</a>
                    @endif
                </div>
            </div>
        </div>

        @if (Auth::user() != null)
          <div class="col-lg-4">
              <div class="card-deck row m-0 justify-content-center">
                  <div class="card-body">

                      {{-- membat pertanyaan --}}
                      <h3>Buat Pertanyaan.</h3>


                      {{-- form --}}
                      <form method="POST" action="/question">
                          @csrf
                          <div class="form-group">
                              <label for="judul">Judul Pertanyaan</label>
                              <input type="text" class=" @error('title') is-invalid @enderror form-control" id="title"
                                  name="title" placeholder="Masukan title Pertanyaan" value="{{old('title')}}" required>
                              @error('title')
                              <div class="invalid-feedback">
                                  {{$message}}
                              </div>
                              @enderror
                          </div>
                          <div class="form-group">
                              <label for="content">Isi Pertanyaan</label>
                              <textarea type="text" class="form-control  @error('content') is-invalid @enderror "
                                  id="summernote" name="content" placeholder="Masukan Pertanyaan kamu!" required
                                  rows="3">{{old('content')}}</textarea>
                              @error('content')
                              <div class="invalid-feedback">
                                  {{$message}}
                              </div>
                              @enderror
                          </div>
                          <div class="form-group">
                              <label for="content">Tag Pertanyaan</label>
                              <textarea type="text" class="form-control @error('content') is-invalid @enderror" id="tag"
                                  name="tags" placeholder="Masukan Tag Pertanyaan kamu!"
                                  required>{{ old('tags') }}</textarea>
                              <small id="tags" class="form-text text-muted">*Pisahkan dengan spasi</small>
                              @error('tags')
                              <div class="invalid-feedback">
                                  {{$message}}
                              </div>
                              @enderror
                          </div>
                          <input type="hidden" name="user_id" id="" value="{{Auth::user()->id}}">
                          <button type="submit" class="btn btn-primary">Buat Pertanyaan!</button>
                      </form>
                  </div>
              </div>
          </div>
        @endif


        <div class="col-lg-8">
            <div class="card-deck row m-0 justify-content-center mb-3">
                <div class="card-body text-center">
                    <h3>Daftar Pertanyaan.</h3>
                    <div class="col-lg-12">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        @if(session('danger'))
                        <div class="alert alert-danger">
                            {{ session('danger') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- daftar pertanyaan --}}

            @if ($questions)
              @foreach ($questions as $question)
                  <div class="row m-0 mb-3">
                      <div class="col-md-12">
                          <div class="shadow-sm rounded p-3">
                              <h4><u><a class="text-dark" href="/pertanyaan/{{$question->slug}}">{{$question->title}}</a></u>
                              </h4>
                              <div class="my-2">
                                  @foreach ($question->tags as $tag)
                                  <a class="badge badge-primary ">{{$tag->name}}</a>
                                  @endforeach
                              </div>
                              <p>{{$question->content}}</p>

                              @foreach ($users as $user)
                              @if ($user->id == $question->user_id)
                              <p class="text-muted">Oleh {{ $user->name }}, {{$question->created_at->format('d M Y')}}
                              </p>
                              @endif
                              @endforeach
                          </div>
                      </div>
                  </div>
                @endforeach
              @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

$(document).ready(function() {
  $('#summernote').summernote();
});
    $(document).ready(function () {
        $('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>')
            .insertAfter('.quantity input');
        $('.quantity').each(function () {
            var spinner = $(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');


            btnUp.click(function () {
                var model = spinner.find('input').data('vote');
                var modelId = spinner.find('input').data('id');
                $(`#vote-${model}-up-${modelId}`).submit();
            });

            btnDown.click(function () {
                var model = spinner.find('input').data('vote');
                var modelId = spinner.find('input').data('id');
                $(`#vote-${model}-down-${modelId}`).submit();
            });
        });
    })

</script>
@endpush

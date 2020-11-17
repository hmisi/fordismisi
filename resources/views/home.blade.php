@extends('layouts.app')
@section('title', 'AyoAsk!')
@section('desc', 'Forum Diskusi tentang Pemrograman Bahasa Indonesia. Ask, Tell, and Share')

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
                </div>
            </div>
        </div>

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
            @foreach ($questions as $question)
            <div class="row m-0 mb-3">
                <div class="col-md-4">
                    <div class="border border-dark rounded p-3">
                        <h4><a class="text-dark" href="/pertanyaan/{{$question->id}}">{{$question->title}}</a>
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
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Aturan Forum AyoAsk!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <ul>
              <li>
                Ingat! Banyak orang punya masalah yang sama akan ikut terbantu ketika kamu bertanya tidak perlu menulis [tolong], [ask], [help], dan sebagainya
                Sopan dan ramah dalam berinteraksi sesama anggota.
              </li>
              <li>
                Pastikan judul dan pertanyaannya relevan dengan masalah Kamu. Bukan hanya menulis "tugas kampus", "ada error dst."
              </li>
              <li>
                Pastikan kamu sudah teliti dan melihat dua kali kesalahan kamu. Kesalahan bukan hanya karena salah menulis atau salah variable. Berusaha dengan maksimal, Sebelum bertanya.
              </li>
              <li>
                Silahkan tandai jawaban sebagai "jawaban terbaik" jika sudah terjawab. Termasuk saat kamu menjawabnya sendiri.
                Jika pertanyaan terjawab sendiri, silahkan tulis jawabannya
              </li>
              <li>
                Konten yang tidak relevan, mengandung spam, SARA atau pornografi akan langung dihapus
              </li>
              <li>
                Jangan buat pertanyaan bercabang, jika pertanyaan sudah terjawab, buka pertanyaan baru untuk pertanyaan yang lain
                Kalau pertanyaan tidak jelas tuliskan di "komentar" bukan "jawaban". "Jawaban khusus untuk menjawab pertanyaan"
              </li>
              <li>
                Tidak ada pembulian!
              </li>
          </ul>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
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

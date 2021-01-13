@extends('layouts.app')
@section('title', 'FORDISMISI')
@section('desc', 'Forum Diskusi tentang Pemrograman Bahasa Indonesia Oleh HMISI. Ask, Tell, and Share')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-xl-12">
            <a href="/home" class="btn btn-success">Pergi Ke Forum Lagi</a>
        </div>
        <div class="col-lg-8">
            <div class="card-deck row m-0 justify-content-center mb-3">
                <div class="card-body text-center">
                    <div class="col-lg-12">
                        @if(session('status'))
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



            {{--  pertanyaan --}}
            <div class="card-deck row m-0 justify-content-center mb-3 shadow-sm rounded p-3">
                <div class="col-sm-12">
                    <h3>{{ $question->title }}</h3>
                    @if (Auth::user() != null)
                      @if($question->user_id == Auth::user()->id)

                          <a href="/pertanyaan/{{ $question->id }}/edit" class="btn btn-sm btn-primary"><i
                                  class="far fa-edit"></i></a>
                          <form action="/pertanyaan/{{ $question->id }}" method="POST" class="d-inline">
                              @method('delete')
                              @csrf
                              <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                          </form>
                      @endif
                    @endif
                    @if ($user->id == $question->user_id)
                    <p class="text-muted">
                      Oleh {{ $user->name }} pada {{$question->created_at->format('d M Y')}}
                    </p>
                    @endif
                    <p class="mt-2">{{ $question->content }}</p>
                </div>
            </div>




            {{--  jawaban --}}
            <h4>Jawaban</h4>
            @if (Auth::user() != null)
              <div class="text-right mt-3">
                  <button class="btn btn-success btn-sm" type="button" data-toggle="collapse"
                      data-target="#collapse{{ $question->id }}" aria-expanded="false"
                      aria-controls="collapse{{ $question->id }}">
                      Jawab Pertanyaan!
                  </button>
                  </p>
                  <div class="collapse" id="collapse{{ $question->id }}">
                      {{-- form --}}
                      <form method="POST" action="/answer">
                          @csrf
                          <div class="form-group">
                              <label for="content">Isi Jawaban</label>
                              <input type="text" name="question_id" value="{{ $question->id }}" hidden>
                              <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                              <input type="text" class="form-control  @error('content') is-invalid @enderror " id="content"
                                  name="content" placeholder="Masukan jawaban kamu!">

                              @error('content')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror

                          </div>
                          <button type="submit" class="btn btn-primary btn-sm">Jawab Pertanyaan!</button>
                      </form>
                  </div>
              </div>
            @else
              <p>Belum ada jawaban nih.. </p>
              <a href="{{route('login')}}" class="btn btn-info">Jawab Pertanyaannya!</a>
            @endif

            {{-- DAFTAR JAWABAN --}}
            @if ($answers !== null)

              @foreach($answers as $answer)
                @if($answer->question_id == $question->id)
                  @if($answer->best_answer == 1)
                            <div class="card-deck row m-0 justify-content-center my-3 shadow-sm rounded p-3 bg-success text-white">
                              <div class="col-sm-12">
                                <h6 class="text-right">
                          @else
                            <div class="card-deck row m-0 justify-content-center my-3 shadow-sm rounded p-3">
                              <div class="col-sm-12">
                                <h6 class="text-right">
                          @endif
                      @endif

                      {{ $answer->content }} - pada {{ $question->created_at->format('D M Y') }} Oleh
                      @foreach ($users as $user)
                          @if($user->id == $answer->user_id)
                              {{ $user->name }}
                          @endif
                      @endforeach

                      {{-- EDIT HAPUS JAWABAN --}}
                      @if (Auth::user() != null)
                        @if($answer->user_id == Auth::user()->id)
                          <a href="/jawaban/{{ $answer->id }}/edit" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                          <form action="/jawaban/{{ $answer->id }}" method="POST" class="d-inline">
                              <span>
                                  @method('delete')
                                  @csrf
                                  <button class="btn btn-sm btn-danger text-right"><i class="far fa-trash-alt"></i></button>
                              </span>
                          </form>
                        @endif
                        @if($question->user_id == Auth::user()->id)
                          <form action="/jawaban/{{ $answer->id }}/approved" method="post" class="d-inline">
                            @method('patch')
                            @csrf
                            <input type="text" value="1" name="best_answer" hidden>
                            <button class="btn" type="submit"><i class="far fa-check-circle"></i></button>
                          </form>
                          @if($answer->best_answer == 1)
                            <form action="/jawaban/{{ $answer->id }}/approved" method="post" class="d-inline">
                                @method('patch')
                                @csrf
                                    <input type="text" value="0" name="best_answer" hidden>
                                    <button class="btn" type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </form>
                          @endif
                        @endif
                      @endif
                    </h6>
                  </div>
                </div>
              @endforeach
        @endif
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

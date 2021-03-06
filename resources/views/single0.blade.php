@extends('layouts.app')
@section('title', 'AyoAsk!')
@section('desc', 'Forum Diskusi tentang Pemrograman Bahasa Indonesia. Ask, Tell, and Share')

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
            {{-- daftar pertanyaan --}}
            @foreach($questions as $question)
                <div class="card-deck row m-0 justify-content-center mb-3">
                    <div class="col-sm-12">
                        <h3>{{ $question->title }}
                            @if($question->user_id == Auth::user()->id)

                                <a href="/pertanyaan/{{ $question->id }}/edit" class="btn btn-sm btn-primary"><i
                                        class="far fa-edit"></i></a>
                                <form action="/pertanyaan/{{ $question->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                            @endif
                        </h3>
                        <div class="my-2">
                            @foreach($question->tags as $tag)
                                <a class="badge badge-primary ">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <p>{{ $question->content }}</p>

                        @foreach($users as $user)
                            @if($user->id == $question->user_id)
                                <p class="text-muted">Oleh {{ $user->name }},
                                    {{ $question->created_at->format('d M Y') }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-12">
                    <h6 class="text-left">- Komentar Pertanyaannya -<a data-toggle="collapse"
                        data-target="#collapse_komentar_pertanyaan{{ $question->id }}" aria-expanded="false"
                        aria-controls="collapse_komentar_pertanyaan{{ $question->id }}"><i
                            class="btn btn-warning far fa-comment"></i></a></h6>

                    <div class="collapse" id="collapse_komentar_pertanyaan{{ $question->id }}">

                        {{-- form --}}
                        <form method="POST" action="/questionComment">
                            @csrf
                            <div class="form-group">
                                <label for="content">Isi Komentar</label>
                                <input type="text" name="question_id" value="{{ $question->id }}" hidden>
                                <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                <input type="text" class="form-control  @error('content') is-invalid @enderror " id="content"
                                    name="content" placeholder="Masukan komentar dari pertanyaan!">
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Komentari Pertanyaan!</button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-12">
                    <h3 class="text-right">- Jawaban -</h3>
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
                    @if (!empty($answers))
                        @foreach($answers as $answer)
                            @if($answer->question_id == $question->id)
                                @if($answer->best_answer == 1)
                                <h5 class="text-right text-primary">
                                @else
                                <h5 class="text-right">
                                @endif
                            @endif
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
                            @else
                                <i class="far fa-check-circle"></i>
                            @endif
                            {{ $answer->content }} - at {{ $question->created_at->format('D M Y') }} Oleh
                            @foreach ($users as $user)
                                @if($user->id == $answer->user_id)
                                    {{ $user->name }}
                                @endif
                            @endforeach
                        @endforeach</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-right"><a data-toggle="collapse" data-target="#collapse_komentar_jawaban{{ $answer->id }}"
                                    aria-expanded="false" aria-controls="collapse_komentar_jawaban{{ $answer->id }}"><i
                                        class="btn btn-warning far fa-comment"></i></a> - Komentar Jawabannya -</h6>

                                <div class="collapse text-right pb-3" id="collapse_komentar_jawaban{{ $answer->id }}">
                                    {{-- form --}}
                                    <form method="POST" action="/answerComment">
                                        @csrf
                                        <div class="form-group">
                                            <label for="content">Isi Komentar</label>
                                            <input type="text" name="answer_id" value="{{ $answer->id }}" hidden>
                                            <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                                            <input type="text" class="form-control  @error('content') is-invalid @enderror " id="content"
                                                name="content" placeholder="Masukan komentar dari Jawaban!">

                                            @error('content')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Komentari Jawaban!</button>
                                    </form>
                                </div>
                                @if (!empty($answerComents))
                                    @foreach($answerComents as $answerComent)
                                        @if($answerComent->answer_id == $answer->id)
                                            <p class="text-muted text-right blockquote-footer mt-3">{{ $answerComent->content }} - at
                                            {{ $answerComent->created_at->format('D M Y') }} Oleh
                                            @foreach ($users as $user)
                                                @if($user->id == $answerComent->user_id)
                                                    {{ $user->name }}
                                                @endif
                                            @endforeach</p>
                                            @if($answerComent->user_id == Auth::user()->id)
                                                <span>
                                                    <a href="/answerComment/{{ $answerComent->id }}/edit" class="btn btn-sm btn-primary"><i
                                                        class="far fa-edit"></i></a>
                                                    <form action="/answerComment/{{ $answerComent->id }}" method="POST" class="d-inline">
                                                        <span>
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-sm btn-danger text-right"><i class="far fa-trash-alt"></i></button>
                                                        </span>
                                                    </form>
                                                </span>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
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

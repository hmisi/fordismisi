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
            {{-- daftar pertanyaan --}}
                <div class="card-deck row m-0 justify-content-center mb-3">
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

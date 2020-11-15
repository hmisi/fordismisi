@extends('layouts.app')
@section('title', 'AyoAsk!')
@section('desc', 'Forum Diskusi tentang Pemrograman Bahasa Indonesia. Ask, Tell, and Share')
@section('content')
<div class="mt-5">
    <div class="row">
        <div class="col-xl-12">
            <header class="text-center mb-3">
                <h1>Ask, Tell and Share!</h1>
            </header>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-5 my-3">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <blockquote class="blockquote text-center">
                        <p class="mb-0">Belajar dari kemarin, hidup untuk sekarang, berharap untuk besok. Hal yang paling penting adalah jangan berhenti bertanya.</p>
                        <footer class="blockquote-footer">Albert Einstein</footer>
                    </blockquote>
                  </div>
                  <div class="carousel-item">
                    <blockquote class="blockquote text-center">
                        <p class="mb-0">Diamnya jauh lebih menyakitkan dibandingkan marahnya. Aku lebih baik dimarahi karena bertanya banyak hal kepadanya, dibandingkan tatapan kosong.</p>
                        <footer class="blockquote-footer">Tere Liye</footer>
                    </blockquote>
                  </div>
                  <div class="carousel-item">
                    <blockquote class="blockquote text-center">
                        <p class="mb-0">Genius is one percent inspiration <br>and ninety-nine percent perspiration.</p>
                        <footer class="blockquote-footer">Thomas A. Edison</footer>
                    </blockquote>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 text-center">
            <p>================================</p>
            <h3 class="pb-2">Dari Developer untuk Developers</h3>
            <p>================================</p>
        </div>
        <div class="col-md-5 text-center mt-3">
            <p>AyoAsk! adalah adalah komunitas terbuka untuk siapa pun yang membuat kode. <br>Saling membantu satusama lain untuk tujuan bersama! </p>
            <a class="btn btn-primary my-3" href="{{url('/home')}}">Mulai Memasuki Forum sekarang</a>
        </div>
    </div>
</div>
@endsection

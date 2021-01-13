@extends('layouts.app')
@section('title', 'FORDISMISI')
@section('desc', 'Forum Diskusi tentang Pemrograman Bahasa Indonesia Oleh HMISI. Ask, Tell, and Share')
@section('content')
<div class="mt-5">
    <div class="row">
        <div class="col-xl-12">
            <header class="text-center mb-3">
                <img src="https://hmisippg.org//assets/img/HMISI.png" alt="" width="150px" class="mb-3">
                <h1>FORDISMISI</h1>
                <p>Forum Diskusi Mahasiswa Informatika <br />dan Sistem Informasi.</p>
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
            <p><b>Forum Diskusi Mahasiswa Informatika dan Sistem Informasi</b> adalah wadah
              untuk menampung diskusi mahasiswa Informatika dan Sistem Informasi.
              Melihat banyak mahasiswa yang kesulitan untuk bertanya tentang Informatika di Kampus.
              Dengan adanya FORDISMISI, Diharapkan mahasiswa bisa menjadi lebih aktif bertanya dan menjawab.</p>
            <a class="btn btn-info my-3" href="{{url('/home')}}">Mulai Memasuki Forum sekarang</a><!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
              Baca Aturan Forum dulu!
          </button>
        </div>
    </div>
</div>
@endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('desc')">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="https://hmisippg.org//assets/img/HMISI.png" type="image/x-icon">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="container">
    <div id="app">
        <div>
            <nav class="navbar mt-5">
                <a class="navbar-brand text-dark" href="{{url('/')}}"><b>FORDISMISI</b></a>
                <div class="form-inline">
                    <!-- Right Side Of Navbar -->
                        <!-- Authentication Links -->
                        @guest
                                <a class="badge badge-primary p-2 mr-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                    <a class="badge badge-warning p-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <div class="dropdown">
                                <b>Hi!</b> <a id="navbarDropdown" class="text-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                </div>
            </div>
        </nav>

            <main class="content">
                @yield('content')
            </main>
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
        <div class="text-center my-5">
            <p>&copy; Copyright FORDISMISI {{date('Y')}}<br>Dibuat dengan [ 🖤 ] untuk Developers</p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
</body>
</html>

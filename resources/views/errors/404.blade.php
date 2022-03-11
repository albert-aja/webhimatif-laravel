<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      404 Page Not Found || Himpunan Mahasiswa Teknologi Informasi - Universitas
      Sumatera Utara
    </title>
    
    <!-- Favicon -->
    <x-favicon/>

    <!-- CSS -->
    <link rel="stylesheet" href={{ asset('css/404.css') }}>
  </head>
  <body>
    <div class="code-area">
      <span>
        <<span class="red">script</span>>
        <span class="d-block">
        <span class="yellow pl-25">
          if 
        </span>
        (<span class="red">page</span>
        <span class="blue-1">!=</span>
        <span class="orange">found</span>){
        </span>
      </span>
      <span>
        <span class="blue-2">return </span>
        <span>(<span class="green">"404 page not found"</span>); </span>
        <span class="d-block pl-25">}</span>
        <<span class="red">/script</span>>
      </span>
      <span class="text">Maaf, halaman yang anda cari tidak ditemukan :( </span>
      <a href={{ url()->previous() }} class="box__button">Kembali</a>
    </div>
  </body>
</html>

<meta charset="UTF-8"/>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
    if(!is_null(Request::segment(1)) && strtolower(Request::segment(1)) == 'artikel'){
        $content = $post['title'];
    } elseif(strtolower(Request::segment(1)) == 'struktur') {
        $content = $divisi_['alias'].' himatif, divisi '.$divisi_['alias'].', ' .$divisi_['alias'];
    } else{
        $content = '';
    }
@endphp

<meta name="keywords" content="himatif, himatif usu, teknologi informasi, himpunan mahasiswa, usu, universitas sumatera utara, website himpunan mahasiswa, web himatif, himatif web, itfest, USU, HIMATIF, HIMATIF USU, TI, itfest usu, himpunan mahasiswa teknologi informasi, {{ $content }}"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"/>
<meta name="robots" content="index, follow"/>

@if(!is_null(Request::segment(1)) && strtolower(Request::segment(1)) == 'artikel')

@php
    $article = strip_tags($post['article'])
@endphp

{!! '<meta name="description" content="' .$article. '"/>
<meta property="og:title" content="' .$post['title']. '" />
<meta property="og:description" content="' .$article. '">
<meta property="og:image" content="' .asset('img/news/hero_image/3x_' .$post['hero_image']). '">
<meta property="og:url" content="' .url()->current(). '" />' !!}
@else
{!! '<meta name="description" content="' .$history['history']. '"/>
<meta property="og:title" content="Himpunan Mahasiswa Teknologi Informasi Universitas Sumatera Utara" />
<meta property="og:description" content="' .$history['history']. '">
<meta property="og:image" content="' .asset('img/logo/himatif.png'). '">
<meta property="og:url" content="' .url()->current(). '" />' !!}
@endif
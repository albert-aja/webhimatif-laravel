@extends('_layout.user._template')

@push('addon-style')
  <link rel="stylesheet" href={{ asset('css/article.css') }}>
@endpush

@section('content')

<section id="news" class="blog">
  <div class="container" data-aos="fade-up">
    <a href="{{ asset($post['hero_image-l']) }}" class="lightbox">
      <img class="blur-up entry-img col-lg img-fluid lazyload" data-src="{{ asset($post['hero_image-l']) }}" src="{{ asset($post['hero_image-m']) }}" alt="<?= $post['title'] ;?>" />
    </a>
    <div class="row entries">
      <div class="col-lg-12">
        <article class="entry entry-single">
          <h1 class="entry-title">
            {{ $post['title'] }}
          </h1>
          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center">
                <i class="bi bi-calendar"></i>
                <a>
                  Tanggal terbit :  <time datetime="{{ $post['date'] }}">{{ $post['date'] }}</time>
                </a>
              </li>
              <li class="d-flex align-items-center">
                <i class="bi bi-book"></i>
                <a>
                  Estimasi waktu baca : {!! $post['readtime'] !!}</time>
                </a>
              </li>
            </ul>
          </div>
          <hr>
          <div class="entry-content">
            <p>
              {!! $post['article'] !!}
            </p>
          </div>
        </article>

        @if(count($latest) > 0)

        <div id="latest-section" class="blog-posts">
          <div class="post-block">
            <h4 class="latest-post">Berita Terbaru</h4>
            <hr>
            <div class="row">

              @foreach($latest as $l)
                <div class="col-lg-4 col-md-6 py-3">
                  <x-post-box :title="$l['title']" :img1="$l['hero_image-l']" :img2="$l['hero_image-m']" :date="$l['created_at']" :article="$l['article']" :slug="$l['slug']" />
                </div>
              @endforeach

            </div>
          </div>
        </div>
        @endif

      </div>
    </div>
  </div>
</section>

@endsection
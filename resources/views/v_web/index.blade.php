@extends('_layout.user._template')

@section('content')

<main id="main">
  <!-- ======= About Section ======= -->
  <section id="about" class="about">

    <div class="container">
      <div class="row">
        <div class="col-lg left-layout">
          <div class="xs-feature-image-box image" data-aos="zoom-in">
            <img class="blur-up lazyload"
              data-src="{{ asset('img/logo/black/black_512.png') }}"
              src="{{ asset('img/logo/black/black_192.png') }}"
              alt="Himatif USU">
          </div>
        </div>
        <div class="col-lg-7 right-layout">
          <div class="xs-feature-text-content">
            <div class="xs-heading" data-aos="fade-up" data-aos-delay="50">
              <h1 class="xs-title" data-title="Sejarah">Sejarah Himatif</h1>
              <span class="xs-separetor"></span>
            </div>
            <p data-aos="fade-up" data-aos-delay="150">{{ $history['history'] }}</p>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- End About Section -->

  <section id="visi" class="visi">

    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-7 left-layout">
          <div class="xs-feature-text-content">
            <div class="xs-heading">
              <h1 class="xs-title" data-title="Visi">Visi Himatif</h1>
              <span class="xs-separetor"></span>
            </div>
            <p>{{ $vision['vision'] }}</p>
          </div>
        </div>
        <div class="col-lg right-layout">
          <div class="xs-feature-image-box image-1" data-aos="fade-left">
            <img class="blur-up lazyload"
              data-src={{ asset('img/web/visi2.jpg') }}
              src={{ asset('img/web/visi2_s.jpg') }}
              alt="Himatif USU">
          </div>
          <div class="xs-feature-image-box image-2" data-aos="fade-right">
            <img class="blur-up lazyload"
              data-src={{ asset('img/web/visi1.jpg') }}
              src={{ asset('img/web/visi1_s.jpg') }}
              alt="Himatif USU">
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- End About Section -->

  <section id="misi" class="misi">

    <div class="container" data-aos="fade-up">
      <div class="middle-layout">
        <div class="xs-feature-text-content row">
          <div class="xs-heading-middle">
            <h1 class="xs-title" data-title="Misi">Misi Himatif</h1>
            <span class="xs-separetor"></span>
          </div>
          @foreach($missions as $mission)
        
          <div class="col-12 col-md-6 px-2 content-misi" data-aos="fade-up" data-aos-delay="{{ $mission['delay'] }}">
            <div class="row-misi">
              <p>{{ $mission['mission'] }}</p>
            </div>
          </div>

          @endforeach
        </div>
      </div>
    </div>

  </section>

  <section id="divisi" class="divisi">

    <div class="container" data-aos="fade-up">
      <div class="middle-layout">
        <div class="xs-feature-text-content">
          <div class="xs-heading-middle">
            <h1 class="xs-title" data-title="Divisi">Divisi Himatif</h1>
            <span class="xs-separetor"></span>
          </div>
          <div class="row content-divisi">

          @foreach($divisions as $division)
            <div class="col-lg-4 col-md-4 mt-4" data-aos="fade-up" data-aos-delay="{{ $division['delay'] }}">
              <div class="icon-box">
                <h2 class="numbering">{{ $division['number'] }}</h2>
                <h3>
                  <a href="{{ route('web-division', $division['slug']) }}" class="stretched-link">
                    {{ $division['division'] }}
                  </a>
                </h3>
              </div>
            </div>
          @endforeach
        
          </div>
        </div>
      </div>
    </div>

  </section>

  <section id="himatif_shop" class="himatif_shop">

    <div class="container" data-aos="fade-up">
      <div class="middle-layout">
        <div class="xs-feature-text-content">
          <div class="xs-heading-middle">
            <h1 class="xs-title" data-title="Shop">Himatif Shop</h1>
            <span class="xs-separetor"></span>
          </div>
          <div class="row content-shop g-3">
            <div class="col firstpic">
              <a href="{{ route('web-himatifshop') }}">
                <span>{{ $category1['category'] }}</span>
              </a>
              <img class="lazyload" src="{{ asset($category1['photo']) }}" alt="{{ $category1['category'] }}" />
            </div>
            <div class="col">
              <div class="row">

                @foreach($category2 as $ct)
                <div class="col-12 nthpic">
                  <a href={{ route('web-himatifshop') }}>
                    <span>{{ $ct['category'] }}</span>
                  </a>
                  <img class="lazyload" src="{{ asset($ct['photo']) }}" alt="{{ $ct['category'] }}" />
                </div>
                @endforeach

              </div>
            </div>
          </div>
          <div class="text-center mt-5">
            <a href="{{ route('web-himatifshop') }}" class="btn btn-seal blog-btn">Cek Produk Kami</a>
          </div>
        </div>
      </div>
    </div>

  </section>

@if($posts->count() > 0)

  <section id="blog-posts" class="blog-posts">

    <div class="container" data-aos="fade-up">
      <div class="middle-layout">
        <div class="xs-feature-text-content">
          <div class="xs-heading-middle">
            <h1 class="xs-title" data-title="Berita">Berita Himatif</h1>
            <span class="xs-separetor"></span>
          </div>
          <div class="row content-berita">
            @foreach($posts as $post)
              <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $post['delay'] }}">
                <x-post-box class="m-3" :title="$post['title']" :img1="$post['hero_image-l']" :img2="$post['hero_image-m']" :date="$post['created_at']" :article="$post['article']" :slug="$post['slug']" />
              </div>
            @endforeach
          </div>
          <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="150">
            <a href="{{ route('web-news') }}" class="btn btn-seal blog-btn">Lihat Semua Berita</a>
          </div>
        </div>
      </div>
    </div>

  </section>
  
@endif
  
  <section id="youtube-video" class="youtube-video">

    <div class="container" data-aos="fade-up">
      <div class="middle-layout">
        <div class="xs-feature-text-content">
          <div class="xs-heading-middle">
            <h1 class="xs-title" data-title="Youtube">Youtube Himatif</h1>
            <span class="xs-separetor"></span>
          </div>
          <div class="row content-youtube">

            @foreach($videos as $video)
              <div class="col-md-6 col-sm-12 video-content" 
                data-aos="fade-up" data-aos-delay="{{ $video['delay'] }}">
                <div class=video-playback>
                  <a class="lazyload latestVideo stretched-link" target="_blank" rel="noopener noreferrer" vnum="{{ $video['display'] }}">
                    <img class="video-thumbnail lazyload" src="" alt="Youtube Himatif USU" />
                    <span class="play-video">
                      <i class="bi bi-play-circle"></i>
                    </span>
                  </a>
                </div>
                <div class="video-desc">
                  <p class="video-title"></p>
                </div>
              </div>
            @endforeach 

            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</main>

@endsection
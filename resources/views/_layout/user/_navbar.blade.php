<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <!-- scroll progress -->
    @if(!is_null(Request::segment(1)))
      @if(strtolower(Request::segment(1)) == 'artikel' || strtolower(Request::segment(2)) == 'preview_article')
        <div class="scroll-progress" id="scroll-progress-top"></div>
      @endif
    @endif

    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo" data-aos="fade-down" data-aos-delay="10">
        <a href={{ route('home') }}>
          <img id="logo-white" src={{ asset('img/logo/white/white_100.png') }} alt="Himatif USU" class="img-fluid"/>
        </a>
        <a href={{ route('home') }}>
          <img id="logo-black" src={{ asset('img/logo/black/black_100.png') }} alt="Himatif USU" class="img-fluid"/>
        </a>
      </div>

      <nav id="navbar" class="navbar">
        <ul class="first-ul">
          <li data-aos="fade-down" data-aos-delay="10">
            <a class="nav-link" href={{ route('home') }}>Home</a>
          </li>
          <li class="dropdown" data-aos="fade-down" data-aos-delay="10">
            <a class="nav-link">
              <span>Divisi</span> 
              <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              @foreach($divisions as $division)
                <li>
                  <a href={{ route('web-division', $division['slug']) }}>
                    <span>
                      {{ $division['division'] }}
                    </span>  
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
          <li data-aos="fade-down" data-aos-delay="10">
            <a class="nav-link" href={{ route('web-himatifshop') }}>Himatif Shop</a>
          </li>
          <li data-aos="fade-down" data-aos-delay="10">
            <a class="nav-link" href={{ route('web-news') }}>Berita</a>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle" data-aos="fade-down" data-aos-delay="10"></i>
      </nav>
    </div>
  </header><!-- End Header -->
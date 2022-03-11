<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 footer-contact">
          <div class="widget-title">
            <a href="https://it.usu.ac.id/" target="_blank" rel="noopener noreferrer">
              <img src={{ asset('img/logo/usu.png') }} alt="Teknologi Informasi USU">
            </a>
            <a href={{ route('home') }}>
              <img src={{ asset('img/logo/white/white_100.png') }} alt="Himatif USU">
            </a>
          </div>
          <p>
            Jalan Universitas No. 9A, <br>
            Kampus USU Padang Bulan,<br>
            Medan, Sumatera Utara 20155 <br>
            <br>
          </p>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Halaman</h4>
          <ul>
            <li><a href={{ route('home') }}>Home</a></li>
            <li><a href={{ route('web-himatifshop') }}>Himatif Shop</a></li>
            <li><a href={{ route('web-news') }}>Berita</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Layanan</h4>
          <ul>
            @foreach($services as $service)
            <li>
              <a href={{ $service['link'] }} target="_blank" rel="noopener noreferrer">
                {{ $service['service'] }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-3 col-md-6">
          <h4>Media Sosial</h4>
          <div class="social-links">

            @foreach($socials as $social)
              <a href={{ $social['link'] }} class="{{ $social['social'] }} social-media" 
                target="_blank" rel="noopener noreferrer" style="background: {{ $social['color'] }}"
                data-bs-toggle="tooltip" data-bs-placement="top" title={{ ucwords($social['social']) }}>
                <i class={{ $social['icon'] }}></i>
              </a>
            @endforeach

          </div>
        </div>

      </div>
    </div>
    <hr>
  
    <div class="container py-4">
      <div class="copyright">
        <p>
          &copy; Copyright <strong><span>{{ date("Y") }}<a href={{ route('admin-login') }}> Himatif USU</a></span></strong>. All Rights Reserved.
        </p>
      </div>
    </div>
  </div>
</footer>
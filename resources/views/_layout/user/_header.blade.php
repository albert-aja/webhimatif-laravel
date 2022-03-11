<section id="hero" class="page">
  
  <section class="breadcrumbs">
    <div class="container d-flex flex-column align-items-center text-center">
      <h1 data-aos="fade-up" data-aos-delay="100">{{ $title }}</h1>
      <ol data-aos="fade-up" data-aos-delay="150">
        @foreach($breadcrumbs as $crumb)
          <li class="text-capitalize">
            {{ $crumb }} 
          </li>
        @endforeach
      </ol>
    </div>
  </section>
  <!-- End Breadcrumbs -->

</section>
<!-- End Hero -->
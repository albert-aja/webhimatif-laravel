@extends('_layout.user._template')

@push('addon-style')
  <link rel="stylesheet" href={{ asset('css/article.css') }}>
@endpush

@section('content')

  <main id="main">
    <!-- ======= Blog Single Section ======= -->
    <section id="news" class="blog">
      <div class="container" data-aos="fade-up">
        <img class="entry-img col-lg-10 img-fluid lightbox" 
        src="<?= $post['hero_img'] ;?>">
        <div class="row entries">
          <div class="col-lg-12">
            <article class="entry entry-single">
              <h1 class="entry-title">
                <?= $post['title'] ;?>
              </h1>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center">
                    <i class="bi bi-clock"></i>
                    <a href="blog-single.html"
                      ><time datetime="<?= $post['created_at'] ;?>"><?= tgl_indonesia($post['created_at']) ;?></time></a
                    >
                  </li>
                </ul>
              </div>
              <hr>
              <div class="entry-content">
                <p>
                  <?= $post['article'] ;?>
                </p>
              </div>

              <div class="entry-footer">

              <i class="bi bi-tags"></i> Tag :
                <ul class="tags">
                  <?php foreach($tag as $t) { ?>
                    <li class="badge rounded-pill bg-primary">
                      <?= $t['tag'] ;?>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </article>
          </div>
          <!-- End blog entries list -->
        </div>
      </div>
    </section>
    <!-- End Blog Single Section -->
  </main>
  <!-- End #main -->

@endsection

@foreach($posts as $post)

  <div class="grid-item col-lg-4 col-md-6 py-3" data-aos="fade-up" data-aos-delay="{{ $post['delay'] }}">
    <x-post-box :title="$post['title']" :img1="$post['hero_image-l']" :img2="$post['hero_image-m']" :date="$post['created_at']" :article="$post['article']" :slug="$post['slug']" />
  </div>

@endforeach
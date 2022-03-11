<div class="post-box">
    <div class="post-img">
        <img alt="{{ $title }}" src="{{ asset($img1) }}" data-src="{{ asset($img2) }}" class="blur-up lazyload img-fluid"/>
    </div>
    <span class="post-date">{{ $date }}</span>
    <h3 class="post-title">{{ $title }}</h3>
    {!! $article !!}
    <a href="{{ route('web-article', $slug) }}" class="readmore stretched-link mt-auto"></a>
</div>

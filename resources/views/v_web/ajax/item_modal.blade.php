@php 
	$img_num = $item['photo']->count();
@endphp

<div class="modal-content">
  	<div class="item-card">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	  	<div class="card_left">
			@if($img_num > 1)
			<div id="item-carousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
				<div class="carousel-indicators">

				@for($i=0;$i<$img_num;$i++)
					<button type="button" data-bs-target="#item-carousel" data-bs-slide-to="{{ $i }}" aria-label="Slide {{ $i }}" @if($i == 0) class="active" aria-current="true" @endif></button>
				@endfor

				</div>
				<div class="carousel-inner">

					@foreach($item['photo'] as $img)
					<div class="carousel-item {{ (($loop->first)) ? 'active' : '' }}">
						<a href="{{ asset($img['photo']) }}" class="lightbox">
							<img src="{{ asset($img['photo']) }}" class="d-block" alt="{{ $item['item'] }}">
						</a>
					</div>
					@endforeach

				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#item-carousel" data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#item-carousel" data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
			@else
				<a href="{{ asset($item['photo']->first()['photo']) }}" class="lightbox">
					<img src="{{ asset($item['photo']->first()['photo']) }}" alt="{{ $item['item'] }}">
				</a>
			@endif
		</div>
		<div class="card_right">
			<p class="item_category">{{ $item['category'] }}</p>
			<h3>{{ $item['item'] }}</h3>
			<span class="price">{{ $item['price'] }}</span>
			<div class="item-description">
				{!! $item['description'] !!}
			@if($colors->count() > 0)
				<p>Pilihan Warna :</p>
				@foreach($colors as $color)
					<span class="product-color" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ucwords($color->product_color['color']) }}" style="background-color: {{ $color->product_color['hex_code'] }}"></span>
				@endforeach
			@endif
			</div>
			<div class="card_footer">
				<span>Info lebih lanjut : </span>
				<div class="social-links">

				@foreach($contacts as $contact)
					<a href="{{ $contact['link'] }}" class="{{ $contact['social'] }} social-media" target="_blank" rel="noopener noreferrer" style="background: {{ $contact['color'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ucwords($contact['social']) }}">
						<i class="{{ $contact['icon'] }}"></i>
					</a>
				@endforeach

				</div>
			</div>
		</div>
	</div>
</div>
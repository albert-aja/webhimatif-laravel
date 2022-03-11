@extends('_layout.user._template')

@section('content')

<section id="shop" class="shop">
    <div id="item-preloader">
        <i class="circle-preloader"></i>
    </div>

    <div class="container">
        <header class="section-header2" data-aos="fade-up">
            <h2>Katalog</h2>
        </header>
        <div class="katalog">
            <div class="col-12" data-aos="fade-up">
                <ul id="item-filter">
                    <li data-filter="*" class="filter-active">Semua</li> 
                    @foreach($categories as $category)
                        @if($category['total_count'] > 0)
                        <li data-filter=".{{ $category['slug'] }}">{{ $category['category'] }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
                <div class="row item-container" data-aos="fade-up">

                    @foreach($items as $item)
                    <div class="grid-item col-6 col-md-4 col-lg-3 g-4 {{ $item['category_slug'] }}">
                        <div class="post-box">
                            <div class="post-img">
                                <img
                                src="{{ asset($item['image-l']) }}"
                                data-src="{{ asset($item['image-m']) }}" 
                                class="blur-up img-fluid lazyload" alt="{{ $item['item'] }}">
                                <div class="item-info">
                                    <a id="trigger-modal" href="#item_modal" class="stretched-link" data-bs-toggle="modal" data-bs-target="#item_modal" data-id={{ $item['id'] }}>
                                        <span>Detail</span>
                                    </a>
                                </div>
                            </div>
                            <div class="post-desc">
                                <h3 class="item-title">{{ $item['item'] }}</h3>
                                <span class="item-price">{{ $item['price'] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="item_modal" tabindex="-1" aria-labelledby="item_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            
        </div>
    </div>
</section> 

@endsection

@push('addon-script')
<script>
    function sosialTooltip(){   
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    $(document).on("click", "#trigger-modal", function() {
        let id = $(this).attr("data-id");

        $.ajax({
            url: "/ajax_request/item_modal/" + id,
            type: "GET",
            dataType: "html", 
            beforeSend: function(){
                $('.modal-content').remove();
                $("#item-preloader").show();
            },
        }).done(function (data) {
            $('#item-preloader').hide(0);
            $('.modal-dialog').append(data).show()
            const Lightbox = GLightbox({
                selector: ".lightbox",
            });
            sosialTooltip();
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('No response');
        });
    })
</script>
@endpush
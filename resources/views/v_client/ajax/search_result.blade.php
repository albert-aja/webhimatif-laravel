<div class="container d-flex justify-content-center">

@if($results)
    <div class="search_result">

    @foreach($results as $result)
        <div class="result_row">
            <img class="search_thumbnail" src="{{ asset ($result['hero_image'] )}}" 
            alt="{{ $result['title'] }}">
            <div class="result_text">
                <span class="result_title">
                    {!! $result['marked_title'] !!}
                </span>
                <span class="result_separator">•</span>
                <span class="result_date">{{ $result['date'] }}</span>
            </div>
            <a class="stretched-link" href={{ route('web-article', $result['slug']) }}"></a>
            <div id="border"></div>
        </div>
    @endforeach

    </div>
@else
    <div class="search_result">
        <div class="no_result_text">
            <span class="no_result_title d-flex justify-content-center">Tidak ada judul yang cocok untuk "{{ $query }}"</span>
        </div>
    </div>
@endif
    
</div>
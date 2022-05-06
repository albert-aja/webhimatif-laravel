@extends('_layout.user._template')

@section('content')

<section id="blog-posts" class="blog-posts">

  <div class="container" data-aos="fade-up">
    <header class="section-header2">
      <h2>Berita</h2>
    </header>
    
    <form class="title-search">
      <div class="inner-form">
        <div class="input-field">
          <div class="search-icon btn-search">
            <img src={{ asset('img/web/search.svg') }} alt="Search">
          </div>
          <input id="search-title" type="text" placeholder="Cari judul berita..." name="search" autocomplete="off">
          <div class="search-icon btn-close"></div>
          <div class="suggestion-box">
            
          </div>
        </div>
      </div>
    </form>
    
    <div id="loader">
      <img src={{ asset('img/web/loader.svg') }} alt="loader">
    </div>

    <div class="row" id="load_post">
      
    </div>
  </div>
</section>

@endsection

@push('addon-script')
<script>
    let page = 0;
    let dataLoad = true;
    let isLoading = false;

    $(document).ready(function(){
        first_load();
    });

    $('form.title-search').on('submit', function(e){
        e.preventDefault();
    });
    
    if($("#load_post").length > 0){
        $(window).scroll(function () {
            let total =  $('#post_total').val();
            if(total == 0){
                return;
            }
            if(total > document.getElementById("load_post").childElementCount - 1){
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 850) {
                    if (isLoading == false) {
                        isLoading = true;
                        page++;
                        if (dataLoad) {
                            load_more(page);
                        }
                    }
                }
            }
        });
    }

    function first_load(page){
        page = 0;

        $.ajax({
            url: "/ajax_request/load_post?page=" + page,
            type: "GET",
            dataType: "html",
            beforeSend: function(){
                $("#loader").show();
                $.ajax({
                    url: "/ajax_request/post_total",
                    type: "GET",
                    dataType: "html",
                }).done(function (total){
                    $('#load_post').append(total).show();
                });
            },
        }).done(function (data) {
            $('#loader').hide();
            $('#load_post').append(data).show();
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('No response');
        });
    }

    function load_more(page) {
        $.ajax({
            url: "/ajax_request/load_post?page=" + page,
            type: "GET",
            dataType: "html", 
            beforeSend: function(){
                $("#loader").show();
            },
        }).done(function (data) {
            isLoading = false;
            $('#loader').hide();
            $('#load_post').append(data).show();
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('No response');
        });
    }
    
    $("#search-title").focus(function() {
        let suggestion = document.querySelector(".suggestion-box");
        
        suggestion.style.opacity = 1;

        if (suggestion.style.opacity == 1) {
            let search = document.querySelector("#search-title");
            search.style.borderRadius = 0;
        }
    });
    
    $(document).ready(function(){
        $("#search-title").keyup(function () {
            let searchText = $(this).val();
            
            let btn_close = document.querySelector(".btn-close");

            btn_close.style.opacity = 1;

            if(searchText == ''){
                btn_close.style.opacity = 0;
            }
            
            if (searchText != "") {
                $.ajax({
                    url: "/ajax_request/search_title?query=" + searchText,
                    type: "GET",
                    dataType: "html",
                }).done(function (data) {
                    $('.suggestion-box').empty()
                    $(".suggestion-box").append(data).show();
                });
            } else {
                $(".suggestion-box").html("");
            }       
        });
    });
</script>
@endpush
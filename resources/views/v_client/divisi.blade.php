@extends('_layout.user._template')

@section('content')

<section id="divisi_page" class="divisi_page">

  <div class="container" data-aos="fade-up">

    <header class="section-header2">
      <h2>{{ $title }}</h2>
    </header>
    <div class="row" id="card">
      @foreach($commitees as $commitee)
      <div class="col-lg-4 col-md-6 py-5" data-aos="fade-up" data-aos-delay="{{ $commitee['delay'] }}">
        <div class="person">
          <div class="card-box">
            <div class="container-inner">
              <div class="circle"></div>
              <img class="img" src="{{ asset($commitee['photo']) }}" style="width: {{ $commitee['photo_width'] }}rem" alt="{{ $division['alias'] }}"/>
            </div>
          </div>
          <div class="divider"></div>
          <div class="name">{{ $commitee['name'] }}</div>
          <div class="title">
            {{ $commitee['position'] }}
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="progja" data-aos="fade-up">
      <header class="section-header2">
        <h2>Program Kerja</h2>
      </header>
      <div class="middle-layout">
        <div class="xs-feature-text-content row">
            @foreach($programs as $program)
            <div class="col-12 col-md-6 px-2 content-progja" data-aos="fade-up" data-aos-delay="{{ $program['delay'] }}">
              <div class="row-progja">
                <h4>{{ $program['program'] }}</h4>
                <p>{{ $program['description'] }}</p>
              </div>
            </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>

</section>

@endsection
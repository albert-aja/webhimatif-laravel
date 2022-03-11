@extends('_layout.form._template')

@section('form')

<div class="back_to_web">
  <a href="{{ route('home') }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
    </svg>
  </a>
</div>

<div class="scroll-down is-closed">
  <img src="{{ asset('img/logo/white/white_512.png') }}" alt="Himatif USU">
</div>
<div class="wpp-block">
  <div id="stars"></div>
  <div id="stars2"></div>
  <div id="stars3"></div>
</div>

<div class="loginModal">
  <div class="modal-container">
    <div class="modal-left">
      <img class="logo" src="{{ asset('img/logo/black/black_100.png') }}" alt="Himatif USU">
      <img
        class="bg"
        src="{{ asset('img/web/login.jpg') }}"
        alt=""
      />
    </div>
    <div class="modal-right">
      <h1 class="modal-title">@lang('auth.login.loginTitle')</h1>
      <p class="modal-desc">
        @lang('auth.login.loginText')
      </p>
      @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form class="user" action="{{ route('auth-attempt') }}" method="post">
        @csrf

        @if(config('auth.valid_fields') === ['email'])
        <div class="input-block">
          <input type="email" name="login" id="email" placeholder="@lang('auth.email')"
            class="form-control @error('login') is-invalid @enderror" value="{{ old('login') }}" required
          />
          @error('login')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        @else
        <div class="input-block">
          <input type="text" name="login" id="email" placeholder="@lang('auth.login.emailOrUsername')"
            class="form-control @error('login') is-invalid @enderror" value="{{ old('login') }}" required
          />
          @error('login')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        @endif

        <div class="input-block">
          <input type="password" name="password" id="password" placeholder="@lang('auth.password')"
            class="form-control @error('password') is-invalid  @enderror" required
          />
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="modal-buttons">
          <div class="form-group">
            <div class="custom-control custom-checkbox small">
              <input type="checkbox" class="custom-control-input" id="customCheck" onclick="password_show_hide();">
              <label class="custom-control-label" for="customCheck">@lang('auth.login.showPassword')</label>
            </div>
          </div>

          <button class="input-button" type="submit">@lang('auth.login.loginAction')</button>
        </div>
      </form>

          <p class="sign-up">
            @if(config('auth.allowRegistration'))
              <a href="{{ route('auth-register') }} ">@lang('auth.login.needAnAccount')</a>
            @endif
                          
            @if(config('auth.activeResetter'))
              <a href="{{ route('auth-forgot') }} ">@lang('auth.login.forgotYourPassword')</a>
            @endif
          </p>
        </div>
        <button class="icon-button close-button">
            <img src="{{ asset('img/web/close.svg') }}" alt="close-btn">
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('addon-script')
  <script src="{{ asset('js/form.js') }}"></script>
@endpush
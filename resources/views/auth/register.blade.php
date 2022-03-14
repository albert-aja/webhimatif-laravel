@extends('_layout.form._template')

@section('form')

<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            <div class="card">
                <h2 class="card-header">@lang('auth.register.registerTitle')</h2>
                <div class="card-body">

                    @includeWhen(session()->has('errorMsg') || session()->has('successMsg'), 'auth._message_block')

                    <form action="{{ route('auth-registration') }}" method="post">
                        @csrf

                        <div class="input-block">
                            <label class="mb-2">@lang('auth.email')</label>
                            <input type="email" name="email" id="email" placeholder="@lang('auth.email')" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                            />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="input-block">
                            <label class="mb-2">@lang('auth.username')</label>
                            <input type="text" name="username" id="username" placeholder="@lang('auth.username')" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required
                            />
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="input-block">
                            <label class="mb-2">@lang('auth.password')</label>
                            <input type="password" name="password" id="password" placeholder="@lang('auth.password')" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required
                            />
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="input-block">
                            <label class="mb-2">@lang('auth.repeatPassword')</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="@lang('auth.repeatPassword')" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" required
                            />
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="input-button mt-1">@lang('auth.register.registerTitle')</button>
                    </form>

                    <hr>

                    <p>@lang('auth.register.alreadyRegistered') <a href="{{ route('auth-login') }}">@lang('auth.signIn')</a></p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('addon-script')
  <script src="{{ asset('js/form.js') }}"></script>
@endpush
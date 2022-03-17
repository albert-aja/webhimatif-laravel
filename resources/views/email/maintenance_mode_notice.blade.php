@extends('email.layout')

@section('email')

<table align="center" cellpadding="0" cellspacing="0" width="95%">
  <tr>
    <td align="center">
      <table class="logo" align="center" cellpadding="0" cellspacing="0" bgcolor="#fff">
        <tr>
          <td class="logo-td" align="center">
            <a href="{{ route('home') }}" target="_blank">
              <img src="{{ asset('img/logo/himatif.png') }}" alt="Himatif USU">
            </a>
          </td>
        </tr>
        <tr>
          <td bgcolor="#fff">
            <table cellpadding="0" cellspacing="0" width="100%%">
              <tr>
                <td class="title-td">
                  @lang('email.maintenance.title')
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td bgcolor="#fff">
            <table cellpadding="0" cellspacing="0" width="100%%">
              <tr>
                <td class="pad-0">
                  @lang('email.maintenance.text1', ['admin' => Auth::user()->username, 'time' => date('m/d/Y h:i a', time())])
                </td>
              </tr>
              <tr>
                <td class="leave-td">
                  @lang('email.maintenance.text2', ['token' => $token])
                </td>
              </tr>
              <tr>
                <td class="regards">
                  @lang('email.auth.thanks'),
                  <p>@lang('global.name')</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

@endsection
@extends('_layout.form._template')

@section('form')

<div aria-live="polite" aria-atomic="true" class="position-relative toast-alert">
  <div class="toast-container position-absolute top-0 end-0 p-3">
      <div class="toast" id="resend-toast">
          <div class="toast-header">
              <img src="{{ asset('img/logo/favicon/logo32.png') }}" class="rounded me-2">
              <strong class="me-auto">@lang('auth.toast.success')</strong>
              <small class="text-muted">{{ App\Helpers\General::indonesia_date(date('Y-m-d')) }}</small>
              <button type="button" class="btn-close" id="close-toast"></button>
          </div>
          <div class="toast-body">
            @lang('auth.toast.resended')
          </div>
      </div>
  </div>
</div>

<div class="container">
  <div class="modal-container row g-0">
    <div class="verification-box">
      <div class="box-header">
        <h1 class="modal-title">{{ $title }}</h1>
        <p class="modal-desc">
          {!! __('auth.verify.checkEmail', $email) !!}
        </p>
      </div>
      <div class="item-content">
        <img src="{{ asset('img/web/inbox.jpg') }}" class="img-center">
        <p>@lang('auth.verify.notice')</p>
        <div class="resend">
          <p>@lang('auth.verify.didnotReceive')</p>
          <button class="btn btn-primary" id="send-btn" data-id="{{ $email }}"></button>
        </div>
      </div>
    </div>
  </div>
</div>

@endSection

@push('addon-script')
  <script>
    function counter($el, s, func) {
      (function loop() {
        $el.html(s);
        if (s--) {
          setTimeout(loop, 1000);
        } else {
          func();
        }
      })();
    }

    var btn = $("#send-btn");
    var msg = __('auth.toast.cooldown');
    var sec = config('auth.resendCooldown');

    function countdown() {
      btn.html(msg).addClass("disabled");
      counter($("#countdown"), sec, updateBtn);
    }
    function updateBtn() {
      btn.text(__('auth.toast.resendText')).removeClass("disabled");
    }

    $(document).ready(function () {
      countdown();
    });

    $("#send-btn").click(function (e) {
      e.preventDefault();
      let email = $(this).attr("data-id");

      $.ajax({
        url: route('auth-resendEmail', email),
        type: "POST",
        beforeSend: function(){
          countdown();
        }
      }).done(function (response) {
        if(response){
          window.location.href = response;
        } else {
          var toastId = $('#resend-toast');
          var toast = new bootstrap.Toast(toastId)
          toastId.css("display", "block");
          toast.show();
        }
      })
    })  
  </script>
@endpush
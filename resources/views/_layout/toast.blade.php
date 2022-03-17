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
                {{ session('message') }}
            </div>
        </div>
    </div>
</div>
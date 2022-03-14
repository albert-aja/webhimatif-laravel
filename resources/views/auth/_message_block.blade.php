@if(session()->has('errorMsg'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('errorMsg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('successMsg'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('successMsg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
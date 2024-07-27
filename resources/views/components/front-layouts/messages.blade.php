@if(session()->has('success'))
  <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>@lang('views.SUCCESS') - </strong> {{ Session()->get('success') }}
  </div>
@endif

@if(Session()->has('error'))
  <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>@lang('views.ERROR') - </strong> {{ Session()->get('error') }}
  </div>
@endif
@if(Session()->has('warning'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>@lang('views.WARNING') - </strong> {{ Session()->get('warning') }}
  </div>
@endif

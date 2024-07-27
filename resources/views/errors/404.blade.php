<x-front-layouts.app>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
          <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
              <div class="col-lg-4">
                <div class="text-center">
                  <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/errorimg.svg" alt="" class="img-fluid">
                  <h1 class="fw-semibold mb-7 fs-9">@lang('views.OPPS')</h1>
                  <h4 class="fw-semibold mb-7">@lang('views.NOT FOUND')</h4>
                  <a class="btn btn-primary" href="{{ route('admin.dashboard') }}" role="button">@lang('views.DASHBOARD')</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-front-layouts.app>

<x-front-layouts.header/>
<div class="preloader" style="display: none;">
    <img src="{{asset('dist/images/logos/favicon.png')}}" alt="loader" class="lds-ripple img-fluid">
  </div>
  <div
    class="page-wrapper"
  id="main-wrapper"
  data-layout="vertical"
  data-navbarbg="skin6"
  data-sidebartype="full"
  data-sidebar-position="fixed"
  data-header-position="fixed"
>
    <x-front-layouts.sidebar/>


<div class="body-wrapper">
    <x-front-layouts.body-header/>

    <div class="container-fluid">
    {{ $slot }}
    </div>
</div>

  </div>
<x-front-layouts.footer/>

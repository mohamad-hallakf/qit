@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page">
  <div class="page-header login-page header-filter" filter-color="blue" style="background-image: url('{{ asset('material') }}/img/cover.png'); background-size: cover; background-position: top center;align-items: center;" data-color="azure">
     @yield('content')

  </div>
</div>

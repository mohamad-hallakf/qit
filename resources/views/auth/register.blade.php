@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>{{ __('Register') }}</strong></h4>

          </div>
          <div class="card-body ">

          <div class="card-footer justify-content-center">

            <a type="submit" href="https://wa.me/963962144905?text= مرحبا, أريد الاستفسار عن هذا التطبيق  " class="btn btn-primary   text-white">   {{ __('Call Admin') }} <i class="fa-solid fa-phone"></i></a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

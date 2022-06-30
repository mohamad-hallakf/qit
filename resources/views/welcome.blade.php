@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          @guest
          <h1 class="text-white text-center mt-3">{{ __('Welcome to QIT Project') }}</h1>
          @endguest
      </div>
  </div>
</div>
@endsection

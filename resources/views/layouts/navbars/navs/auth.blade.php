<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top shadow" id="side">
    <div class="container-fluid">
        <div class="navbar-wrapper  ">
            {{-- <a class="navbar-brand" href="#">{{ $titlePage }}</a> --}}

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            {{-- <form class="navbar-form">
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form> --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fa fa-lg fa-solid fa-gauge text-info"></i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Stats') }}
                        </p>
                    </a>
                </li>
                {{-- notify --}}
                @auth


                    <li class="nav-item dropdown" id="notify">
                        @php

                            $notifications = optional(auth()->user())->unreadNotifications;
                            $notifications_count = optional($notifications)->count();
                            $notifications_latest = optional($notifications)->take(5);
                        @endphp

                        <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                            <i class="fa fa-lg  fa-solid fa-bell text-info"></i>
                            @isset($notifications_count)
                                <span class="notification">{{ $notifications_count }}</span>
                            @endisset

                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if ($notifications_latest)
                                @foreach ($notifications_latest as $notification)
                                    @php
                                        $notification_text = isset($notification->data['title']) ? $notification->data['title'] : $notification->data['text'];
                                    @endphp
                                    <a class="dropdown-item"
                                        href="{{ route('notifications.show', $notification->id) }}">{{ $notification_text }}</a>
                                @endforeach
                            @endif


                        </div>
                    </li>
                @endauth
                {{-- notify --}}
                <li class="nav-item dropdown">

                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown">
                        <i class=" fa fa-lg fa-solid fa-user text-info"></i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Account') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="#"> {{ auth()->user()->name }}</a>
                        <hr>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div id="alertPlace" style="margin-top:60px "></div>

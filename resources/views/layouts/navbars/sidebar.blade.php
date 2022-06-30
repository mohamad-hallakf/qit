<style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .h1,
    .h2,
    .h3,
    .h4 {
        font-family: "arial";
    }
</style>
<div class="sidebar" data-color="azure" data-background-color="white"
    data-image="{{ asset('material') }}/img/sidebar-1.jpg">

    <div class="logo">
        <a href="{{ route('home') }}"class="simple-text logo-normal font-weight-bold ">


            {{ __('Quality For IT') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if (auth()->user()->role != 'admin')
                <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fa fa-lg fa-solid fa-house-chimney"></i>
                        <p>Main Page</p>
                    </a>
                </li>
            @endif
            <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('notifications.index') }}">
                    <i class="fa fa-lg  fa-solid fa-bell"></i>
                    <p>notifications</p>
                </a>
            </li>

            @if (auth()->user()->role == 'admin')
                <li class="nav-item{{ $activePage == 'test' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('test.index') }}">
                        <i class="fa fa-lg fa-brands fa-servicestack"></i>
                        <p>Tests</p>
                    </a>
                </li>

                <li class="nav-item{{ $activePage == 'questionsIndex' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('question.index') }}">
                        <i class="fa fa-lg fa-solid fa-question"></i>
                        <p>Question Record</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ $activePage == 'profile' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
                        <i class=" fa fa-lg  fa-solid fa-screwdriver-wrench"></i>
                        <p> User Managament
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="laravelExample">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'user-marks' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('user.marks') }}">
                                    <span class="sidebar-mini">   <i class=" fa fa-lg   fa-brands fa-servicestack"></i></span>
                                    <span class="sidebar-normal"> Students Marks</span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    <span class="sidebar-mini"> <i class=" fa fa-lg  fa-solid fa-user"></i> </span>
                                    <span class="sidebar-normal"> Students Accounts</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

        </ul>
    </div>
</div>
<style>
    p {
         font-weight: bold
    }
</style>

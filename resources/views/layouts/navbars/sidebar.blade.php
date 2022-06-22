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
        <a href="{{ route('home') }}"class="simple-text logo-normal font-weight-bold">
            <i class=" fa fa-lg fa-solid fa-baby mx-2"> </i>

            {{ __('Baby Care') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if (auth()->user()->role != 'admin')
                <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fa fa-lg fa-solid fa-house-chimney"></i>
                        <p>الصفحة الرئيسية</p>
                    </a>
                </li>
            @endif
            <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('notifications.index') }}">
                    <i class="fa fa-lg  fa-solid fa-bell"></i>
                    <p>الاشعارات</p>
                </a>
            </li>
            @if (auth()->user()->role != 'admin')
                <li class="nav-item{{ $activePage == 'questions' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('question.questions') }}">
                        <i class="fa fa-lg fa-solid fa-question-circle"></i>
                        <p>استشارات طبية</p>
                    </a>
                </li>



                <li class="nav-item{{ $activePage == 'mychildren' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('child.mychildren') }}">
                        <i class="fa fa-lg fa-solid fa-child"></i>
                        <p>اطفالي</p>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'admin')
                <li class="nav-item{{ $activePage == 'services' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('service.index') }}">
                        <i class="fa fa-lg fa-brands fa-servicestack"></i>
                        <p>الخدمات</p>
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'children' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('child.index') }}">
                        <i class="fa fa-lg fa-solid fa-child"></i>
                        <p>الاطفال</p>
                    </a>
                </li>

                <li class="nav-item{{ $activePage == 'childsub' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('ChildSub.index') }}">
                        <i class="fa-solid fa-gamepad"></i>
                        <p>اشتراكات الاطفال</p>
                    </a>
                </li>

                <li class="nav-item{{ $activePage == 'Subscription' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('Subscription.index') }}">
                        <i class="fa fa-lg fa-solid fa-registered"></i>
                        <p>سجل الاشتراكات</p>
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'questionsIndex' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('question.index') }}">
                        <i class="fa fa-lg fa-solid fa-question"></i>
                        <p>سجل الاسئلة</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ $activePage == 'profile' || $activePage == 'user-management' ? ' active' : '' }}">
                    <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
                        <i class=" fa fa-lg  fa-solid fa-screwdriver-wrench"></i>
                        <p>ادارة المستخدمين
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse show" id="laravelExample">
                        <ul class="nav">
                            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    <span class="sidebar-mini"> UP </span>
                                    <span class="sidebar-normal">الملف الشخصي </span>
                                </a>
                            </li>
                            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    <span class="sidebar-mini"> UM </span>
                                    <span class="sidebar-normal"> سجل المشتركين</span>
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
        font-size: 17px !important;
        font-weight: bold
    }
</style>

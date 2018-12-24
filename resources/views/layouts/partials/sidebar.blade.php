<nav class="sidebar sidebar-offcanvas" id="sidebar">
    
    @if (Auth::User()->isA('Admin'))

    <ul class="nav">

        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                <img src="{{asset('/images/faces/face1.jpg')}}" alt="profile">
                <span class="login-status online"></span>              
                </div>
                <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
                <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <span class="menu-title">Home</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users') }}">
                <span class="menu-title">{{ trans('app.users.users') }}</span>
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('roles') }}">
                <span class="menu-title">{{ trans('app.roles.roles') }}</span>
                <i class=" mdi mdi-account-key menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('referrals') }}">
                <span class="menu-title">{{ trans('app.referrals.referrals') }}</span>
                <i class="mdi mdi-link menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">{{ trans('app.videos.videos') }}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-message-video menu-icon"></i>
            </a>

            <div class="collapse" id="ui-basic" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('videocategories') }}">{{ trans('app.categories') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('videos') }}">{{ trans('app.videos.videos') }}</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('courses') }}">
                <span class="menu-title">{{ trans('app.courses.courses') }}</span>
                <i class="mdi mdi-school menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-order" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">{{ trans('app.orders.orders') }}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi mdi-cart menu-icon"></i>
            </a>

            <div class="collapse" id="ui-order" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('videocategories') }}">{{ trans('app.orders.orders') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('orderlost') }}">{{ trans('app.orders.lost.ordersLost') }}</a></li>
                </ul>
            </div>
        </li>

    </ul>

    @endif

    @if (Auth::User()->isA('User'))

    <ul class="nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.edit',Auth::user()->id) }}">
                <span class="menu-title">Mi cuenta</span>
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#ui-courses" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">{{ trans('app.courses.courses') }}</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-school menu-icon"></i>
            </a>

            <div class="collapse" id="ui-courses" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('courses') }}">{{ trans('app.listOf') }} {{ trans('app.courses.courses') }}</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('courses.mycourses') }}">{{ trans('app.courses.myCourses') }}</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item"> 
            <a class="nav-link" href="{{ route('videos.show') }}">
                <span class="menu-title">{{ trans('app.videos.videos') }}</span>
                <i class="mdi mdi-message-video menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('webminar.show') }}">
                <span class="menu-title">Webminar</span>
                <i class="mdi mdi-at menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('referrals') }}">
                <span class="menu-title">Referidos</span>
                <i class="mdi mdi-link menu-icon"></i>
            </a>
        </li>
        

        <li style="opacity: 0.6;" class="nav-item">
            <a class="nav-link">
                <span class="menu-title">RED</span>
                <i class=" mdi mdi-minus-network menu-icon"></i>
            </a>
        </li>

        <li style="opacity: 0.6;" class="nav-item">
            <a class="nav-link">
                <span class="menu-title">Mensajería</span>
                <i class=" mdi mdi-facebook-messenger menu-icon"></i>
            </a>
        </li>

        <li style="opacity: 0.6;" class="nav-item">
            <a class="nav-link">
                <span class="menu-title">Señales</span>
                <i class=" mdi mdi-signal menu-icon"></i>
            </a>
        </li>

        <li style="opacity: 0.6;" class="nav-item">
            <a class="nav-link">
                <span class="menu-title">Documentación</span>
                <i class=" mdi mdi-file-document menu-icon"></i>
            </a>
        </li>

        <li style="opacity: 0.6;" class="nav-item">
            <a class="nav-link">
                <span class="menu-title">Intercambio monedas</span>
                <i class="mdi mdi-stackexchange menu-icon"></i>
            </a>
        </li>

        <li style="opacity: 0.6;" class="nav-item">
            <a class="nav-link">
                <span class="menu-title">Avisos</span>
                <i class=" mdi mdi-led-on menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('support') }}" class="nav-link">
                <span class="menu-title">Soporte</span>
                <i class=" mdi mdi-settings menu-icon"></i>
            </a>
        </li>

    </ul>

    @endif

</nav>
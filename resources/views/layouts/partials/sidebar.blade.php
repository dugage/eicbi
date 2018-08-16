<nav class="sidebar sidebar-offcanvas" id="sidebar">
    
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
                <i class=" mdi mdi-link menu-icon"></i>
            </a>
        </li>

    </ul>

</nav>
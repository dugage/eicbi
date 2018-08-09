<div class="page-header">

    <h3 class="page-title"> @yield('contentheadertitle')Dashboard</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            {{--<li class="breadcrumb-item active" aria-current="page">Icons</li>--}}
            @yield('breadcrumb')
        </ol>
    </nav>
</div>
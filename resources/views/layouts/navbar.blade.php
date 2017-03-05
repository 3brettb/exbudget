<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'ExBudget') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (Auth::user())
                    <li>
                            <a href="{{url('/accounts')}}">
                            <span class="fa fa-university" aria-hidden="true"></span> Accounts<span class="sr-only">(current)</span></a>
                    </li>
                    @if(Auth::user()->current_account)
                        <?php $a_id = Auth::user()->current_account; ?>
                        <li>
                                <a href="{{url("/account/$a_id/dashboard")}}">
                                <i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard<span class="sr-only">(current)</span>
                                </a>
                        </li>
                        <li>
                                <a href="{{url("/account/$a_id/analytics")}}">
                                <i class="fa fa-pie-chart" aria-hidden="true"></i> Analytics<span class="sr-only">(current)</span>
                                </a>
                        </li>
                    @endif
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                    <li><a href="{{ url('/register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>{{Auth::user()->firstname}} {{Auth::user()->lastname}}<span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{url('/profile')}}">
                                    <i class="fa fa-user" aria-hidden="true"></i> Profile<span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout<span class="sr-only">(current)</span>
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
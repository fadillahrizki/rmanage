
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RManage - @yield('title')</title>
    <link href="{{asset('jquery-ui/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('materialize/css/materialize.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="fixed-navbar">
        <nav>
            <div class="nav-wrapper purple">
                <div class="container">
                    <div class="row">
                        <div class="col s3">
                            <a href="{{url('/')}}" class="brand-logo">RManage</a>
                            <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        </div>
                        <div class="col s6 hide-on-med-and-down">
                            <form action="{{route('home')}}" method="GET">
                                <div class="input-field white-text">
                                    <input type="text" name="search" value="{{old('search')}}" placeholder="Search..." class="validate white-text" >
                                </div>
                            </form>
                        </div> 
                        <div class="col s3 hide-on-med-and-down">
                            <ul class="right">
                                @guest
                                    <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="/register">Register</a></li>
                                    <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="/login">Login</a></li>
                                @else
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();$('#logout-form').submit();">Logout ( {{Auth::user()->name }} )</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div> 
            </div>
        </nav>
        <ul class="sidenav" id="mobile">
             @guest
                <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="/register">Register</a></li>
                <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="/login">Login</a></li>
            @else
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();$('#logout-form').submit();">Logout ( {{Auth::user()->name }} )</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                </form>
            @endguest
        </ul>
    </div>

    @yield('content')


    <script src="{{asset('jquery-ui/external/jquery/jquery.js')}}"></script>
    <script src="{{asset('jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{asset('materialize/js/materialize.min.js')}}"></script>
    
    <script>
        
        $('.sidenav').sidenav();
        $('.modal').modal();

        function search(text){
            console.log(text);
        }        

    </script>

    @yield('script')

</body>
</html>

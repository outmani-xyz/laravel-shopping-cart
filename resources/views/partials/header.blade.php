<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-left">
            <li><a href='{{ route('product.index') }}'>Home</a></li>
            <li><a href='#'>Something</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{{ route('product.shoppingcart') }}" >
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                    <span class="badge">{{ Session::has('cart')? Session::get('cart')->totalQty:'' }}</span>
                </a> 
            </li>
            <li class="dropdown">
                <a href="#" class="btn btn-default dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="glyphicon glyphicon-user"></i>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    @if(Auth::check())
                    <li><a href="{{ route('user.profile') }}">Profile</a></li>
                    <li><a href="{{ route('user.logout') }}">log out</a></li>
                    @else
                    <li><a href="{{ route('user.signup') }}">Sign up</a></li>
                    <li><a href="{{ route('user.signin') }}">Sign in</a></li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>

</nav>
@include('partials.infos')
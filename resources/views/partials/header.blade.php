@if (Route::has('login'))
<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container">
        @auth
            <a class="navbar-brand" href="{{ url('/home') }}">Home</a>
            <a class="navbar-brand" href="{{ route('admin.home') }}">Admin</a>
        @else
            <a class="navbar-brand" href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a class="navbar-brand" href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
</nav>
@endif



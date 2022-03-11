@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a class="p-4" href="{{ url('/home') }}">Home</a>
        @else
            <a class="p-4" href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a class="p-4" href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif
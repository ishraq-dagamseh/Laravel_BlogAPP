<!DOCTYPE html>
<html>
<head><title>Blog App</title></head>
<body>
@auth
<p>Welcome, {{ auth()->user()->name }}</p>
@else
<p>Guest User</p>
@endauth
<div class="container">
@yield('content')
</div>
{{-- Blade Comment Example --}}
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System</title>
</head>
<body>

    {{-- Header --}}
    <header>
        <h2>Banking System</h2>
        <nav>
            <a href="/accounts">All Accounts</a>
        </nav>
    </header>

    {{-- Main Content --}}
    <main>
        @if(session('success'))
            <p style="color:green">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p style="color:red">{{ session('error') }}</p>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        <p>Banking System &copy; {{ date('Y') }}</p>
    </footer>

</body>
</html>
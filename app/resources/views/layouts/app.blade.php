<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Peer Tutoring Hub</title>

    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>

    <header class="site-header">
        <div class="header-inner">
            <a class="brand" href="{{ route('requests.index') }}">
    Peer Tutoring Hub
</a>

            <nav aria-label="Main navigation">
    <a
        href="{{ route('requests.index') }}"
        @if (request()->routeIs('requests.index', 'requests.show'))
            aria-current="page"
        @endif
    >
        Tutoring requests
    </a>

    <a
        href="{{ route('requests.create') }}"
        @if (request()->routeIs('requests.create'))
            aria-current="page"
        @endif
    >
        Request a session
    </a>
</nav>
        </div>
    </header>

    <main id="main-content" class="page">
        @yield('content')
    </main>

    <footer class="site-footer">
        <p>Peer Tutoring Hub · Laravel classroom demo</p>
    </footer>
</body>
</html>
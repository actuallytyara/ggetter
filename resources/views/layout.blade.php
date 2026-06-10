<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GoalsGetter')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-" crossorigin="anonymous">
    <link href="{{ asset('css/goals.css') }}" rel="stylesheet">
</head>
<body>
    @include('partials.nav')
    <main class="py-4">
        <div class="container">
            <div id="back-button-container" class="mb-3" style="display: none;">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.history.back();">
                    ← Back
                </button>
            </div>
        
        @if(session('success'))
            <div style="background-color: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="{{ asset('js/goals.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var backButtonContainer = document.getElementById('back-button-container');
            if (window.history.length > 1) {
                backButtonContainer.style.display = 'block';
            }
        });
    </script>
    @stack('scripts')
</body>
</html>


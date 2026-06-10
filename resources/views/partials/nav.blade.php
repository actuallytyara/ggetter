<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') ?? url('/') }}">
      <img src="{{ asset('images/Group 1.png') }}" alt="Goals Getter Logo" class="width=" 60" height="60" object-contain
        mr-2">
      <span class="brand-name">GoalsGetter</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') ?? url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('guide') }}">Guide</a></li>
        @if(!session('user_email') && !request()->routeIs('login', 'register'))
          <li class="nav-item">
            <a class="btn btn-outline-success ms-2" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-success ms-2 text-white" href="{{ route('register') }}">Get Started</a>
          </li>
        @elseif(session('user_email'))
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
              {{ session('user_name') }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ route('dashboard') }}">
                  Dashboard
                </a>
              </li>
              <li>
                <form method="POST" action="/logout">
                  @csrf
                  <button class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-wrapper">
    <nav class="mt-2" aria-label="Main navigation">
      <ul class="nav sidebar-menu flex-column">
        <li class="nav-item">
          <a href="{{ route('users') }}" class="nav-link">
            <i class="nav-icon bi bi-people"></i>
            <p>Users</p>
          </a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
              <i class="nav-icon bi bi-box-arrow-right"></i>
              <p>Logout</p>
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>
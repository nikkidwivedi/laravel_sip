{{-- ======= Sidebar ======= --}}
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>{{-- End Dashboard Nav --}}

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('settings.profile') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>{{-- End Profile Page Nav --}}

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('sips.index') }}">
          <i class="bi bi-person"></i>
          <span>Sip List</span>
        </a>
      </li>{{-- End SIP Page Nav --}}

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('invoices.index') }}">
          <i class="bi bi-person"></i>
          <span>Invoice List</span>
        </a>
      </li>{{-- End Invoice Page Nav --}}

      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="nav-link collapsed bg-transparent border-0 w-100 text-start">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </button>
        </form>
      </li>{{-- End Logout Nav --}}

    </ul>

  </aside>{{-- End Sidebar--}}
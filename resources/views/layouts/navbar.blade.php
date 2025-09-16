<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        {{-- Site Logo --}}
        @if(setting('site_logo'))
            <a class="navbar-brand brand-logo" href="{{ url('/') }}">
                <img src="{{ asset(setting('site_logo')) }}" alt="Site Logo" class="w-100 h-auto"/>
            </a>
        @endif

        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
        </a>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex text-dark">Welcome to your dashboard!</h5>
        <ul class="navbar-nav navbar-nav-right ms-auto">

            {{-- Search Bar --}}
            <li class="nav-item">
                <form class="search-form d-none d-md-block" action="#">
                    <i class="icon-magnifier text-muted"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>

            {{-- Main Icons (e.g., Cart, Chart) --}}
            <li class="nav-item d-none d-lg-flex">
                <a href="#" class="nav-link"><i class="icon-basket-loaded text-dark"></i></a>
            </li>
            <li class="nav-item d-none d-lg-flex">
                <a href="#" class="nav-link"><i class="icon-chart text-dark"></i></a>
            </li>

            {{-- Messages Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="icon-speech text-dark"></i>
                    <span class="count bg-primary">7</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <h6 class="dropdown-header">Messages</h6>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <img src="{{ asset('assets/images/faces/face10.jpg') }}" alt="image" class="img-sm rounded-circle profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                            <p class="font-weight-light small-text text-muted"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center font-weight-bold text-primary" href="#">View all messages</a>
                </div>
            </li>

            {{-- Language Dropdown --}}
            <li class="nav-item dropdown d-none d-sm-flex align-items-center">
                <a class="nav-link dropdown-toggle" id="LanguageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="flag-icon flag-icon-us text-dark"></i>
                    <span class="profile-text font-weight-normal ms-2">English</span>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                    <a class="dropdown-item"><i class="flag-icon flag-icon-us me-2"></i> English </a>
                    <a class="dropdown-item"><i class="flag-icon flag-icon-fr me-2"></i> French </a>
                    <a class="dropdown-item"><i class="flag-icon flag-icon-ae me-2"></i> Arabic </a>
                    <a class="dropdown-item"><i class="flag-icon flag-icon-ru me-2"></i> Russian </a>
                </div>
            </li>

            {{-- User Profile Dropdown --}}
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- User Profile Image --}}
                     <img class="img-xs rounded-circle"
     src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/50' }}"
     alt="profile image">

                    <span class="font-weight-normal ms-2 text-dark">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-xs rounded-circle"
     src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/50' }}"
     alt="profile image">

                        <p class="mb-1 mt-3 text-dark">{{ auth()->user()->name }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('admin.profile.view') }}"><i class="dropdown-item-icon icon-user text-primary me-2"></i> My Profile</a>

                    <a class="dropdown-item" href="{{ route('admin.notifications.index') }}">
                        <i class="dropdown-item-icon icon-speech text-primary me-2"></i> Notifications
                        @php
                            $unread = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
                        @endphp
                        @if($unread > 0)
                            <span class="badge bg-danger ms-2">{{ $unread }}</span>
                        @endif
                    </a>

                    <a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="dropdown-item-icon icon-energy text-primary me-2"></i> Settings</a>
                    <a class="dropdown-item" href="{{ route('admin.faq') }}"><i class="dropdown-item-icon icon-question text-primary me-2"></i> FAQ</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="dropdown-item-icon icon-power text-primary me-2"></i> Sign Out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>

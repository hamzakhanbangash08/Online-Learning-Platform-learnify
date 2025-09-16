<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="profile-image">
         <img class="img-xs rounded-circle" 
     src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/50' }}" 
     alt="profile image">

          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
          <p class="profile-name">{{ Auth::user()->name }}</p>
          <p class="designation">
        {{ Auth::user()->getRoleNames()->first() == 'admin' ? 'Administrator' : 'User' }}
          </p>
        </div>
      </a>
    </li>

    <li class="nav-item nav-category"><span class="nav-link">Dashboard</span></li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <span class="menu-title">Dashboard</span>
        <i class="icon-screen-desktop menu-icon"></i>
      </a>
    </li>

    <li class="nav-item nav-category"><span class="nav-link">Learning Management</span></li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.courses.my') }}">
        <span class="menu-title">Courses</span>
        <i class="icon-book-open menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.lessons.index') }}">
        <span class="menu-title">Lessons</span>
        <i class="icon-layers menu-icon"></i>
      </a>
    </li>

    @if(Auth::user()->role == 'admin')
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#quiz-menu" aria-expanded="false" aria-controls="quiz-menu">
        <span class="menu-title">Lesson Quizzes</span>
        <i class="icon-question menu-icon"></i>
      </a>
      <div class="collapse" id="quiz-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.quizzes.index') }}">All Quizzes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.questions.index') }}">Questions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.options.index') }}">Options</a>
          </li>
        </ul>
      </div>
    </li>
    @endif

    <li class="nav-item nav-category"><span class="nav-link">Reporting & Analytics</span></li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.analytics') }}">
        <span class="menu-title">Analytics</span>
        <i class="icon-chart menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.quiz.leaderboard') }}">
        <span class="menu-title">Leaderboard</span>
        <i class="icon-trophy menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.certificates.index') }}">
        <span class="menu-title">My Certificates</span>
        <i class="icon-badge menu-icon"></i>
      </a>
    </li>

    <li class="nav-item nav-category"><span class="nav-link">Help</span></li>
    <li class="nav-item">
      <a class="nav-link" href="https://laravel.com/docs" target="_blank">
        <span class="menu-title">Documentation</span>
        <i class="icon-folder-alt menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>

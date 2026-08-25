
<aside class="sidebar" id="sidebar">


    <!-- Brand Section -->
    <div class="sidebar-brand">
      <div class="brand-wrapper">
        <div class="brand-main">
          Fitness<span style="color: #22c55e;">365</span>
        </div>
        <p class="brand-tagline">Active School. Active Communities</p>
      </div>
    </div>

   

    <div class="nav-section">
      
     <a href="{{ route('new-dashboard') }}" 
       class="nav-item {{ request()->routeIs('new-dashboard') ? 'active' : '' }}">
      <i class="fas fa-chart-pie"></i> Dashboard
    </a>


    <a href="{{ route('demo-page') }}" 
       class="nav-item {{ request()->routeIs('demo-page') ? 'active' : '' }}">
      <i class="fas fa-chart-pie"></i> Learn Sports
    </a>

      
      <div class="nav-item"><i class="fas fa-user-circle"></i> Fill Dart</div>
      <div class="nav-item"><i class="fas fa-share-alt"></i> View Dart</div>
      <div class="nav-item"><i class="fas fa-store"></i> Activity Planner</div>
      <div class="nav-item"><i class="fas fa-lock"></i> Map Students</div>
    </div>

    <div class="nav-section">
      <div class="nav-item"><i class="fas fa-chart-pie"></i> Take Test</div>
      <div class="nav-item"><i class="fas fa-star"></i> Test Summary (Upto Class-3)</div>
      <div class="nav-item"><i class="fas fa-wallet"></i> Test Summary (Class-4 & Above)</div>
      <div class="nav-item"><i class="fas fa-users"></i> Test Summary (CWSN)<span class="nav-badge">only</span></div>
    </div>

    <div class="nav-section">
      <div class="nav-item"><i class="fas fa-box"></i> Get Active</div>
      <div class="nav-item"><i class="fas fa-cubes"></i> Training Mannual</div>
      <div class="nav-item"><i class="fas fa-shopping-cart"></i> Batteries of Test</div>
    </div>

    <div class="nav-section">
      <div class="nav-item"><i class="fab fa-facebook"></i> Activity Gallary</div>
      <div class="nav-item"><i class="fab fa-instagram"></i> Skill Reports</div>
    </div>

    <div class="sidebar-footer">
      <div class="nav-item"><i class="fas fa-store-alt"></i> <a href="{{ url('loginpage') }}">LogOut</a></div>
      <div class="nav-item"><i class="fas fa-user-tie"></i> Profile Setting</div>
      {{-- <div class="nav-item"><i class="fas fa-concierge-bell"></i> Store-Services <span class="nav-badge soon">Soon</span></div> --}}
    </div>
  </aside>

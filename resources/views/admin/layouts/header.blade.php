 <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
	 
			
		  <a href="" class="nav-link"> You are Logged in as <?php $role = \App\Models\Role::where('id',Auth::user()->role_id)->first(); print_r(ucfirst($role->name)); ?></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
	  <li class="nav-item">
		    <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); 
           document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
           @csrf
          </form>
        </li>
	   </li>
              
    </ul>
  </nav>
  <!-- /.navbar -->
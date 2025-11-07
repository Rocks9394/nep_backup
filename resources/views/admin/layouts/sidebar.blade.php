<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4 side-bg" style="background:#f2f2f2;">

    <!-- Sidebar -->
    <div class="sidebar side-nav-cl" style="color:black;">
      <!-- Sidebar user panel (optional) -->
	  <!--{{ route('academyhome')}}-->
     
		<a href="{{ route('admin.dashboard') }}" class="brand-link" style=" display: flex; align-items: center; ">
			<img src="http://103.65.20.170/goforfit/resources/images/goforfit-logo-i.svg" class="brand-image" alt="logo icon">
			<span class="brand-text font-weight-light" style="color:black;">
			  {{ Auth::user()->name }}
			</span>
		</a>
	  
		@php $admins_role = Auth::user()->role_id;  $route = Route::current(); $routename = $route->getName(); @endphp
      
	  
      <nav class="mt-2 nav-bg" style="color:#000000;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">          
		 
			<li class="nav-item menu-open">
				<a href="{{ route('admin.dashboard') }}" class="nav-link active">
				  <i class="nav-icon fas fa-tachometer-alt"></i> 
				  <p>
					Web
					<i class="right fas fa-angle-left"></i>
				  </p>
				</a>
			</li>
		
			<li class="nav-item"> <br> </li>
		
			<li class="nav-item act @if($routename =='admin.activities.index') {{ 'active' }} @endif " style="color:black;" >
				<a href="{{ route('admin.activities.index')}}" class="nav-link">
					<i class="nav-icon fa fa-tasks" aria-hidden="true" style="color:black;"></i>
					<p style="color:black;">Activity</p>
				</a>
			</li>
				
		<li class="nav-item @if(in_array($routename, array('admin.concepts.index','admin.subjects.index','admin.chapters.index', 'admin.classes.index'))) {{ ' menu-is-opening menu-open' }} @endif" >
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree" style="color:black;"></i>
              <p style="color:black;">
                Academics
                <i class="fas fa-angle-left right" style="color:black;"></i>
              </p >
            </a>
			
            <ul class="nav nav-treeview">
			
              <li class="nav-item">
					<a href="{{ route('admin.concepts.index') }}" class="nav-link @if($routename =='admin.concepts.index') {{ 'active' }} @endif">
						<i class="fa fa-window-restore" aria-hidden="true" style="color:black;"></i>
					  <p style="color:black;">Concepts</p>
					</a>
				</li>
	
				
				<li class="nav-item">
					<a href="{{ route('admin.chapters.index') }}" class="nav-link @if($routename =='admin.chapters.index') {{ 'active' }} @endif">
					  <i class="fa fa-sticky-note" aria-hidden="true" style="color:black;"></i>
					  <p style="color:black;">Chapter</p>
					</a>
				</li>
				
				
				@if($admins_role == '1')
				<li class="nav-item">
					<a href="{{ route('admin.subjects.index') }}" class="nav-link @if($routename =='admin.subjects.index') {{ 'active' }} @endif">
						<i class="fa fa-bars" aria-hidden="true" style="color:black;"></i>
					  <p style="color:black;">Subjects</p>
					</a>
				</li>
				@endif
				
				@if($admins_role == '1')
				<li class="nav-item">
					<a href="{{ route('admin.classes.index') }}" class="nav-link @if($routename =='admin.classes.index') {{ 'active' }} @endif">
						<i class="fa fa-book" aria-hidden="true" style="color:black;"></i>
					  <p style="color:black;">Classes</p>
					</a>
				</li>
				@endif
			  
			  
            </ul>
          </li>
		  
				
		  
		  
			@if($admins_role == '4' || $admins_role == '1')
			
				
			<li class="nav-item">
				<a href="{{ route('admin.teachers.index') }}" class="nav-link">
				  <i class="nav-icon fa fa-window-restore" style="color:black;"></i>
				  <p style="color:black;"> Teacher </p>
				</a>
			</li>
			
			@endif
				
				
			
			<!-- 
				@if($admins_role == '1')
				<li class="nav-item">
				    <a id="stoclsmyBtn" style="cursor:pointer;color: #007bff;" data-toggle="modal" data-target="#stoclsmyModal"><i class="fa fa-plus-circle" aria-hidden="true"> ( Add Subject To Class ) </i></a>
				</li>
				@endif
				
					
				
				@if($admins_role == '1')
				<li class="nav-item">
					<a href="{{ route('admin.bulkconcepts.index') }}" class="nav-link">
					<i class='fas fa-mail-bulk' aria-hidden="true"></i>
					  <p>Bulk Concepts</p>
					</a>
				</li>
				@endif
				@if($admins_role == '1')
				<li class="nav-item">
					<a href="{{ route('admin.tags.index') }}" class="nav-link">
						<i class="fa fa-address-card" aria-hidden="true"></i>
					  <p>Manage Tag</p>
					</a>
				</li>
				@endif
				@if($admins_role == '1')
				<li class="nav-item">
					<a href="{{ route('admin.actweakness.index') }}" class="nav-link">
					  <i class="nav-icon fas fa-user-friends"></i>
					  <p>Activity Weakness</p>
					</a>
				</li>
				@endif
				@if($admins_role == '1')
				<li class="nav-item">
					<a href="importactivity" class="nav-link">
					  <i class="fa fa-upload" aria-hidden="true"></i>
					  <p>Upload Activity</p>
					</a>
				</li>
				@endif
				@if($admins_role == '1')
				<li class="nav-item">
					<a href="importchapter" class="nav-link">
					<i class="fa fa-upload" aria-hidden="true"></i>
					  <p>Upload Chapter</p>
					</a>
				</li>
				@endif
				-->
				@if($admins_role == '1')
				<li class="nav-item">
					<a href="{{ route('admin.users.index') }}" class="nav-link">
						<i class="nav-icon fa fa-user-plus" aria-hidden="true" style="color:black;"></i>
					  <p style="color:black;"> Users</p>
					</a>
				</li>
				@endif
				
				@if($admins_role == '1')
				<li class="nav-item" style="color:black;">
					<a href="#" class="nav-link">
					 <i class="nav-icon fas fa fa-clone" style="color:black;"></i>
					  <p style="color:black;">
						Sports/Skills/Techniques
						<i class="fas fa-angle-left right" style="color:black;"></i>
					  </p>
					</a>
					<ul class="nav nav-treeview">
					
					 <li class="nav-item">
					<a href="{{ route('admin.skills.index') }}" class="nav-link">
						<i class="nav-icon fa fa-window-restore" aria-hidden="true" style="color:black;"></i>
					  <p style="color:black;"> Skill Area</p>
					</a>
						
					</li>
					
					
					  <li class="nav-item">
						<a href="{{ route('admin.sports.index') }}" class="nav-link">
						<i class="nav-icon fa fa-window-restore" aria-hidden="true" style="color:black;"></i>
						<p style="color:black;"> Skill/Sports</p>
						</a>
						
					</li>

					
						
						 <li class="nav-item">
					<a href="{{ route('admin.techniques.index') }}" class="nav-link">
						<i class="nav-icon fa fa-window-restore" aria-hidden="true" style="color:black;"></i>
					  <p style="color:black;"> Technique</p>
					</a>
					
					</li>
					
					 <!-- <li class="nav-item">
					<a href="{{ route('admin.sportskills.index') }}" class="nav-link">
						<i class="nav-icon fa fa-university" aria-hidden="true"></i>
					  <p>Class-Sport-Skill</p>
					</a>
					</li>-->              
					</ul>
				</li>
				@endif
				
				<li class="nav-item">
					<a href="#" class="nav-link">
					 <i class="nav-icon fas fa fa-upload" style="color:black;"></i>
					  <p style="color:black;">
						Upload Excel
						<i class="fas fa-angle-left right" style="color:black;"></i>
					  </p>
					</a>

					<ul class="nav nav-treeview">

						<li class="nav-item">
			         <a href="{{ route('admin.manage-activity') }}" class="nav-link">
			            <i class="nav-icon fa fa-tasks" aria-hidden="true" style="color:black;"></i>
			            <p style="color:black;">Manage Activity</p>
			         </a>
			      </li>

						<li class="nav-item">
						  <a href="importactivity" class="nav-link">
							   <i class="fa fa-upload" aria-hidden="true" style="color:black;"></i>
							   <p style="color:black;">Upload Activity</p>
						  </a>
				    </li>
				
						<li class="nav-item">
							<a href="importchapter" class="nav-link">
								<i class="fa fa-upload" aria-hidden="true" style="color:black;"></i>
								<p style="color:black;">Upload Chapter</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('admin.importconcept') }}" class="nav-link">
								<i class="fa fa-upload" style="color:black;"></i>
								<p style="color:black;"> Upload Concepts </p>
							</a>
						</li>

				  @if($admins_role == '1') 
					<li class="nav-item">
						<a href="{{ route('admin.upload') }}" class="nav-link">
						  <i class="fa fa-upload" style="color:black;"></i>
						  <p style="color:black;"> Upload School </p>
						</a>
					</li>
					
					<li class="nav-item">
						<a href="{{ route('admin.uploadteachers') }}" class="nav-link">
						  <i class="fa fa-upload" style="color:black;"></i>
						  <p style="color:black;"> Upload Principal/Teachers </p>
						</a>
					</li>
					
				
				 <li class="nav-item">
				<a href="{{ route('admin.teacherupload') }}" class="nav-link">
				  <i class="fa fa-upload" style="color:black;"></i>
				  <p style="color:black;"> Upload PGTs </p>
				</a>
				</li>
				@endif
			 </ul>
		</li>
				
		  @if($admins_role == '1')
			
				
			<li class="nav-item">
				<a href="{{ route('admin.schools.index') }}" class="nav-link">
				  <i class="nav-icon fa fa-graduation-cap" style="color:black;"></i>
				  <p style="color:black;"> Schools </p>
				</a>
			</li>
			
			@endif
			
			
				
			<li class="nav-item">
				<a href="{{ route('admin.students.index') }}" class="nav-link">
				  <i class="nav-icon fas fa-user-graduate" style="color:black;"></i>
				  <p style="color:black;"> Students </p>
				</a>
			</li>
			
			
		  
			<!-- </ul> -->
		
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<nav id="sidebar" class="sidebar-links">
        <div class="sidebar-header">
            <h2>Hello, {{ Auth::user()->name }}</h2>
        </div>
        <ul class="lisst-unstyled components">
            <!--
            <li class="active">
                <a href="#foodSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">DropDown
                    Menu</a>
                <ul class="collapse lisst-unstyled" id="foodSubmenu">
                    <li><a href="#">jQuery</a></li>
                    <li><a href="#">Script</a></li>
                    <li><a href="#">Net</a></li>
                </ul>
            </li>
				-->
            <li class="{{ (request()->is('add-activity')) ? 'active' : '' }}" >
                <a  href="{{ route('addactivity') }}">Add Activity</a>
            </li>
            <li class="{{ (request()->is('my-activities')) ? 'active' : '' }}">
                <a  href="{{ route('myactivities') }}">My Activities</a>
            </li>
        </ul>
</nav>
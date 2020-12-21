<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ image_exist('/admins/img/admins/', Auth::user()->photo, true) }}" width="90" height="90" alt="logo">
                <h6 class="">{{ Auth::user()->name." ".Auth::user()->lastname }}</h6>
                <p class="">{!! typeUser(Auth::user()->type) !!}</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ active(['admin', 'admin/profile', 'admin/profile/edit']) }}">
                <a href="{{ route('admin') }}" aria-expanded="{{ menu_expanded(['admin', 'admin/profile', 'admin/profile/edit']) }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Home</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/administrators', 0) }}">
                <a href="{{ route('administradores.index') }}" aria-expanded="{{ menu_expanded('admin/administrators', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user-tie"></i> Administrators</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/implementers', 0) }}">
                <a href="{{ route('implementadores.index') }}" aria-expanded="{{ menu_expanded('admin/implementers', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user"></i> Implementers</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/banners', 0) }}">
                <a href="{{ route('banners.index') }}" aria-expanded="{{ menu_expanded('admin/banners', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-image"></i> Banners</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/testimonials', 0) }}">
                <a href="{{ route('testimonios.index') }}" aria-expanded="{{ menu_expanded('admin/testimonials', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-quote-left"></i> Testimonials</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/settings', 0) }}">
                <a href="{{ route('ajustes.edit') }}" aria-expanded="{{ menu_expanded('admin/settings', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-cogs"></i> Settings</span>
                    </div>
                </a>
            </li>
        </ul>

    </nav>

</div>
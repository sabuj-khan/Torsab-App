<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title></title>

    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}" />
    <link href="{{asset('assets/admin/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/fontawesome.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/toastify.min.css')}}" rel="stylesheet" />

    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css')}}" rel="stylesheet" />
    

    <link href="{{asset('https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />


    <link href="{{asset('assets/admin/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/admin/js/jquery-3.7.0.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>


    <script src="{{asset('assets/admin/js/toastify-js.js')}}"></script>
    <script src="{{asset('assets/admin/js/axios.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/config.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap.bundle.js')}}"></script>




</head>

<body>

<div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
</div>

<nav class="navbar fixed-top px-0 shadow-sm bg-white">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                <img class="nav-logo-sm mx-2"  src="{{asset('assets/admin/images/menu.svg')}}" alt="logo"/>
            </span>
            <img class="nav-logo  mx-2"  src="{{asset('assets/admin/images/logo.png')}}" alt="logo"/>
        </a>

        <div class="float-right h-auto d-flex">
            <div class="user-dropdown">
                <img class="icon-nav-img" src="{{asset('assets/admin/images/user.webp')}}" alt=""/>
                <div class="user-dropdown-content ">
                    <div class="mt-4 text-center">
                        <img class="icon-nav-img" src="{{asset('assets/admin/images/user.webp')}}" alt=""/>
                        <h6>User Name</h6>
                        <hr class="user-dropdown-divider  p-0"/>
                    </div>
                    <a href="{{url('/userProfile')}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Profile</span>
                    </a>
                    <a href="{{url("/logout")}}" class="side-bar-item">
                        <span class="side-bar-item-caption">Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>


<div id="sideNavRef" class="side-nav-open">

    <a href="{{url("/dashboard")}}" class="side-bar-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt"></i>
        {{-- <i class="fa fa-chevron-circle-right  text-dark"></i> --}}
        <span class="side-bar-item-caption">Dashboard</span>
    </a> 

    <a href="{{url("/")}}" class="side-bar-item" target="_blunk">
        <i class="fas fa-tachometer-alt"></i>
        <span class="side-bar-item-caption">Visit Site</span>
    </a>


    <a href="{{url("/allPosts")}}" class="side-bar-item {{ Request::is('allPosts') ? 'active' : '' }}">
        <i class="fas fa-book"></i>
        <span class="side-bar-item-caption">Posts</span>
    </a>

    @if(request()->header('user_type') == 'admin')

    <a href="{{url("/addNewPosts")}}" class="side-bar-item {{ Request::is('addNewPosts') ? 'active' : '' }}">
        <i class="fas fa-pencil-alt"></i>
        <span class="side-bar-item-caption">Add New Post</span>
    </a>

    @endif

    <a href="{{url("/categoryPage")}}" class="side-bar-item {{ Request::is('categoryPage') ? 'active' : '' }}">
        <i class="fas fa-folder"></i>
        <span class="side-bar-item-caption">Category</span>
    </a>

    <a href="{{url("/tagPage")}}" class="side-bar-item {{ Request::is('tagPage') ? 'active' : '' }}">
        <i class="fas fa-tags"></i>
        <span class="side-bar-item-caption">Tags</span>
    </a>

    <a href="{{url("/allUsers")}}" class="side-bar-item">
        <i class="fas fa-users"></i>
        {{-- <i class="fa fa-chevron-circle-right  text-dark"></i> --}}
        <span class="side-bar-item-caption">Users</span>
    </a>

    <a href="{{url('/reportPage')}}" class="side-bar-item">
        <i class="fas fa-file-alt"></i>
        <span class="side-bar-item-caption">Report</span>
    </a>


</div>


<div id="contentRef" class="content">
    @yield('content')
</div>



<script>
    function MenuBarClickHandler() {
        let sideNav = document.getElementById('sideNavRef');
        let content = document.getElementById('contentRef');
        if (sideNav.classList.contains("side-nav-open")) {
            sideNav.classList.add("side-nav-close");
            sideNav.classList.remove("side-nav-open");
            content.classList.add("content-expand");
            content.classList.remove("content");
        } else {
            sideNav.classList.remove("side-nav-close");
            sideNav.classList.add("side-nav-open");
            content.classList.remove("content-expand");
            content.classList.add("content");
        }
    }
</script>

</body>
</html>
<header id="topnav">
    <div class="container">
      <!-- Logo container-->
      <div class="logo">
        <a href="{{ url('/') }}">
          <img src="{{ asset('assets/front/images/logo_light.png') }}" alt="" class="logo-light">
          <img src="{{ asset('assets/front/images/logo_dark.png') }}" alt="" class="logo-dark">
        </a>
      </div>
      <!-- End Logo container-->
      <div class="menu-extras">
        <div class="menu-item">
          <!-- Search Form-->
          <div class="search">
            <a href="#">
              <i class="ti-search"></i>
            </a>
            <div class="search-form">
              <form action="#" class="inline-form">
                <div class="input-group">
                  <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn"><button type="button" class="btn btn-color"><span><i class="ti-search"></i></span>
                  </button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <!-- End search form-->
        </div>
        <div class="menu-item">
          <!-- Mobile menu toggle-->
          <a class="navbar-toggle">
            <div class="lines">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </a>
          <!-- End mobile menu toggle-->
        </div>
      </div>
      <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">
          <li class="">
            <a href="{{ url('/') }}">Home</a>
            
          </li>
          <li class="">
            <a href="{{ '/aboutPage' }}">About Us</a>
            
          </li>
          
          <li class="">
            <a href="{{ url('/blogPage') }}">Blog</a>
          
          </li>

          
          <li class="">
            <a href="{{ url('/contactPage') }}">Contact Us</a>
            
          </li>
        </ul>
        <!-- End navigation menu        -->
      </div>
    </div>
  </header>
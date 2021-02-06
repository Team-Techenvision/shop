<div class="horizontal-menu">
  <nav class="navbar top-navbar">
    <div class="container">
      <div class="navbar-content">
        <a href="#" class="brand-logo">
         <!-- Dr<span>&nbsp;Help Desk</span> -->
         <img src="{{asset('assets/images/logo.png') }}" alt="profile" class="img-fluid">
        </a>
        <!-- <form class="search-form">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i data-feather="search"></i>
              </div>
            </div>
            <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
          </div>
        </form> -->
        <ul class="navbar-nav">
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="font-weight-medium ml-1 mr-1">English</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="languageDropdown">
              <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ml-1"> English </span></a>
              <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-fr" title="fr" id="fr"></i> <span class="ml-1"> French </span></a>
              <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-de" title="de" id="de"></i> <span class="ml-1"> German </span></a>
              <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-pt" title="pt" id="pt"></i> <span class="ml-1"> Portuguese </span></a>
              <a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-es" title="es" id="es"></i> <span class="ml-1"> Spanish </span></a>
            </div>
          </li> -->
          <!-- <li class="nav-item dropdown nav-apps">
            <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i data-feather="grid"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="appsDropdown">
              <div class="dropdown-header d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium">Web Apps</p>
                <a href="javascript:;" class="text-muted">Edit</a>
              </div>
              <div class="dropdown-body">
                <div class="d-flex align-items-center apps">
                  <a href="{{ url('/apps/chat') }}"><i data-feather="message-square" class="icon-lg"></i><p>Chat</p></a>
                  <a href="{{ url('/apps/calendar') }}"><i data-feather="calendar" class="icon-lg"></i><p>Calendar</p></a>
                  <a href="{{ url('/email/inbox') }}"><i data-feather="mail" class="icon-lg"></i><p>Email</p></a>
                  <a href="{{ url('/general/profile') }}"><i data-feather="instagram" class="icon-lg"></i><p>Profile</p></a>
                </div>
              </div>
              <div class="dropdown-footer d-flex align-items-center justify-content-center">
                <a href="javascript:;">View all</a>
              </div>
            </div>
          </li> -->
          <!-- <li class="nav-item dropdown nav-messages">
            <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i data-feather="mail"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="messageDropdown">
              <div class="dropdown-header d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium">9 New Messages</p>
                <a href="javascript:;" class="text-muted">Clear all</a>
              </div>
              <div class="dropdown-body">
                <a href="javascript:;" class="dropdown-item">
                  <div class="figure">
                    <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                  </div>
                  <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                      <p>Leonardo Payne</p>
                      <p class="sub-text text-muted">2 min ago</p>
                    </div>	
                    <p class="sub-text text-muted">Project status</p>
                  </div>
                </a>
                <a href="javascript:;" class="dropdown-item">
                  <div class="figure">
                    <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                  </div>
                  <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                      <p>Carl Henson</p>
                      <p class="sub-text text-muted">30 min ago</p>
                    </div>	
                    <p class="sub-text text-muted">Client meeting</p>
                  </div>
                </a>
                <a href="javascript:;" class="dropdown-item">
                  <div class="figure">
                    <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                  </div>
                  <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                      <p>Jensen Combs</p>												
                      <p class="sub-text text-muted">1 hrs ago</p>
                    </div>	
                    <p class="sub-text text-muted">Project updates</p>
                  </div>
                </a>
                <a href="javascript:;" class="dropdown-item">
                  <div class="figure">
                    <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                  </div>
                  <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                      <p>Amiah Burton</p>
                      <p class="sub-text text-muted">2 hrs ago</p>
                    </div>
                    <p class="sub-text text-muted">Project deadline</p>
                  </div>
                </a>
                <a href="javascript:;" class="dropdown-item">
                  <div class="figure">
                    <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
                  </div>
                  <div class="content">
                    <div class="d-flex justify-content-between align-items-center">
                      <p>Yaretzi Mayo</p>
                      <p class="sub-text text-muted">5 hr ago</p>
                    </div>
                    <p class="sub-text text-muted">New record</p>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer d-flex align-items-center justify-content-center">
                <a href="javascript:;">View all</a>
              </div>
            </div>
          </li> -->
          <!-- <li class="nav-item dropdown nav-notifications">
            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i data-feather="bell"></i>
              <div class="indicator">
                <div class="circle"></div>
              </div>
            </a>
            <div class="dropdown-menu" aria-labelledby="notificationDropdown">
              <div class="dropdown-header d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium">6 New Notifications</p>
                <a href="javascript:;" class="text-muted">Clear all</a>
              </div>
              <div class="dropdown-body">
                <a href="javascript:;" class="dropdown-item">
                  <div class="icon">
                    <i data-feather="user-plus"></i>
                  </div>
                  <div class="content">
                    <p>New customer registered</p>
                    <p class="sub-text text-muted">2 sec ago</p>
                  </div>
                </a>
                <a href="javascript:;" class="dropdown-item">
                  <div class="icon">
                    <i data-feather="gift"></i>
                  </div>
                  <div class="content">
                    <p>New Order Recieved</p>
                    <p class="sub-text text-muted">30 min ago</p>
                  </div>
                </a>
                <a href="javascript:;" class="dropdown-item">
                  <div class="icon">
                    <i data-feather="alert-circle"></i>
                  </div>
                  <div class="content">
                    <p>Server Limit Reached!</p>
                    <p class="sub-text text-muted">1 hrs ago</p>
                  </div>
                </a>
                <a href="javascript:;" class="dropdown-item">
                  <div class="icon">
                    <i data-feather="layers"></i>
                  </div>
                  <div class="content">
                    <p>Apps are ready for update</p>
                    <p class="sub-text text-muted">5 hrs ago</p>
                  </div>
                </a>
                <a href="javascript:;" class="dropdown-item">
                  <div class="icon">
                    <i data-feather="download"></i>
                  </div>
                  <div class="content">
                    <p>Download completed</p>
                    <p class="sub-text text-muted">6 hrs ago</p>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer d-flex align-items-center justify-content-center">
                <a href="javascript:;">View all</a>
              </div>
            </div>
          </li> -->
          <li class="nav-item dropdown nav-profile">
            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{asset('assets/images/logo.png') }}" alt="profile" class="img-fluid">
            </a>
            <div class="dropdown-menu" aria-labelledby="profileDropdown">
              <div class="dropdown-header d-flex flex-column align-items-center">
                <div class="figure mb-3">
                  <img src="{{asset('assets/images/logo.png') }}" alt="" class="img-fluid w-100">
                </div>
                <div class="info text-center">
                  <p class="name font-weight-bold mb-0">
                  <?php  if(Auth::user()->name != ""){
                   echo Auth::user()->name;
                  } ?>
                  </p>
                  <p class="email text-muted mb-3">
                 <?php  if(Auth::user()->email != ""){
                   echo Auth::user()->email;
                  } ?>
                  </p>
                </div>
              </div>
              <div class="dropdown-body">
                <ul class="profile-nav p-0 pt-3">
                  <li class="nav-item">
                   <a href="javascript:;" class="nav-link"> <!--  {{ url('/general/profile') }} -->
                      <i data-feather="user"></i>
                      <span>Profile</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                      <i data-feather="edit"></i>
                      <span>Change Password</span>
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                      <i data-feather="repeat"></i>
                      <span>Switch User</span>
                    </a>
                  </li> -->
                  <li class="nav-item">
                    <a href="{{url('/logout')}}" class="nav-link">
                      <i data-feather="log-out"></i>
                      <span>Log Out</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
          <i data-feather="menu"></i>					
        </button>
      </div>
    </div>
  </nav>
  <nav class="bottom-navbar">
    <div class="container">
      <ul class="nav page-navigation">
        <li class="nav-item {{ active_class(['/']) }}">
          <a class="nav-link" href="{{ url('home-bash') }}">
            <i class="link-icon" data-feather="box"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item {{ active_class(['email/*', 'apps/*']) }}">
          <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            <span class="menu-title">Shop Manage</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
              <li class="category-heading">  Shop Employee</li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/inbox']) }}" href="{{url('/view-Emplist')}}">List</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/read']) }}" href="{{url('/Add-employee')}}">Add Employee</a></li>              
              
            </ul>
          </div>
        </li>
        <li class="nav-item {{ active_class(['email/*', 'apps/*']) }}">
          <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            <span class="menu-title">Product</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
              <!-- <li class="category-heading">Shop Employee</li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/inbox']) }}" href="#">List</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/read']) }}" href="#">Add</a></li>               -->
              <li class="category-heading">Stock</li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/chat']) }}" href="{{ url('/View-Stock') }}">list</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/calendar']) }}" href="{{ url('/Add-Stock') }}">Add</a></li>             
              
            </ul>
          </div>
        </li>

        <li class="nav-item {{ active_class(['email/*', 'apps/*']) }}">
          <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>
            <span class="menu-title">Orders</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
            <li class="category-heading">Shop Order List</li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/chat']) }}" href="{{ url('/list-invoice') }}">Show List</a></li>
            <li class="category-heading">Customer Order</li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/chat']) }}" href="{{ url('/cust-order') }}">Add order</a></li>
              
              <!-- <li class="category-heading">Order</li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/inbox']) }}" href="{{ url('/email/inbox') }}">Inbox</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/read']) }}" href="{{ url('/email/read') }}">Read</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/compose']) }}" href="{{ url('/email/compose') }}">Compose</a></li>
              <li class="category-heading">Other<li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/chat']) }}" href="{{ url('/apps/chat') }}">Chat</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/calendar']) }}" href="{{ url('/apps/calendar') }}">Calendar</a></li> -->
            </ul>
          </div>
        </li>
        <li class="nav-item {{ active_class(['email/*', 'apps/*']) }}">
          <a href="#" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
            <span class="menu-title">Reports</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
            <li class="category-heading">Reports</li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/chat']) }}" href="#">Report</a></li>
              <!--href="{{ url('/cust-report') }}"-->
              
              <!-- <li class="category-heading">Order</li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/inbox']) }}" href="{{ url('/email/inbox') }}">Inbox</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/read']) }}" href="{{ url('/email/read') }}">Read</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['email/compose']) }}" href="{{ url('/email/compose') }}">Compose</a></li>
              <li class="category-heading">Other<li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/chat']) }}" href="{{ url('/apps/chat') }}">Chat</a></li>
              <li class="nav-item"><a class="nav-link {{ active_class(['apps/calendar']) }}" href="{{ url('/apps/calendar') }}">Calendar</a></li> -->
            </ul>
          </div>
        </li>
        <!-- <li class="nav-item mega-menu {{ active_class(['ui-components/*', 'advanced-ui/*']) }}">
          <a href="#" class="nav-link">
            <i class="link-icon" data-feather="feather"></i>
            <span class="menu-title">UI Kit</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <div class="col-group-wrapper row">
              <div class="col-group col-md-9">
                <div class="row">
                  <div class="col-12">
                    <p class="category-heading">Basic</p>
                    <div class="submenu-item">
                      <div class="row">
                        <div class="col-md-4">
                          <ul>
                            <li class="nav-item"><a href="{{ url('/ui-components/alerts') }}" class="nav-link {{ active_class(['ui-components/alerts']) }}">Alerts</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/badges') }}" class="nav-link {{ active_class(['ui-components/badges']) }}">Badges</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/breadcrumbs') }}" class="nav-link {{ active_class(['ui-components/breadcrumbs']) }}">Breadcrumbs</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/buttons') }}" class="nav-link {{ active_class(['ui-components/buttons']) }}">Buttons</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/button-group') }}" class="nav-link {{ active_class(['ui-components/button-group']) }}">Buttn Group</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/cards') }}" class="nav-link {{ active_class(['ui-components/cards']) }}">Cards</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/carousel') }}" class="nav-link {{ active_class(['ui-components/carousel']) }}">Carousel</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/collapse') }}" class="nav-link {{ active_class(['ui-components/collapse']) }}">Collapse</a></li>
                          </ul>
                        </div>
                        <div class="col-md-4">
                          <ul>
                            <li class="nav-item"><a href="{{ url('/ui-components/dropdowns') }}" class="nav-link {{ active_class(['ui-components/dropdowns']) }}">Dropdowns</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/list-group') }}" class="nav-link {{ active_class(['ui-components/list-group']) }}">List group</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/media-object') }}" class="nav-link {{ active_class(['ui-components/media-object']) }}">Media object</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/modal') }}" class="nav-link {{ active_class(['ui-components/modal']) }}">Modal</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/navs') }}" class="nav-link {{ active_class(['ui-components/navs']) }}">Navs</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/navbar') }}" class="nav-link {{ active_class(['ui-components/navbar']) }}">Navbar</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/pagination') }}" class="nav-link {{ active_class(['ui-components/pagination']) }}">Pagination</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/popovers') }}" class="nav-link {{ active_class(['ui-components/popovers']) }}">Popovers</a></li>
                          </ul>
                        </div>
                        <div class="col-md-4">
                          <ul>
                            <li class="nav-item"><a href="{{ url('/ui-components/progress') }}" class="nav-link {{ active_class(['ui-components/progress']) }}">Progress</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/scrollbar') }}" class="nav-link {{ active_class(['ui-components/scrollbar']) }}">Scrollbar</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/scrollspy') }}" class="nav-link {{ active_class(['ui-components/scrollspy']) }}">Scrollspy</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/spinners') }}" class="nav-link {{ active_class(['ui-components/spinners']) }}">Spinners</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/tabs') }}" class="nav-link {{ active_class(['ui-components/tabs']) }}">Tabs</a></li>
                            <li class="nav-item"><a href="{{ url('/ui-components/tooltips') }}" class="nav-link {{ active_class(['ui-components/tooltips']) }}">Tooltips</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-group col-md-3">
                <div class="row">
                  <div class="col-12">
                    <p class="category-heading">Advanced</p>
                    <div class="submenu-item">
                      <div class="row">
                        <div class="col-md-12">
                          <ul>
                            <li class="nav-item"><a href="{{ url('/advanced-ui/cropper') }}" class="nav-link {{ active_class(['advanced-ui/cropper']) }}">Cropper</a></li>
                            <li class="nav-item"><a href="{{ url('/advanced-ui/owl-carousel') }}" class="nav-link {{ active_class(['advanced-ui/owl-carousel']) }}">Owl carousel</a></li>
                            <li class="nav-item"><a href="{{ url('/advanced-ui/sweet-alert') }}" class="nav-link {{ active_class(['advanced-ui/sweet-alert']) }}">Sweetalert</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li> -->
        <!-- <li class="nav-item {{ active_class(['forms/*']) }}">
          <a href="#" class="nav-link">
            <i class="link-icon" data-feather="inbox"></i>
            <span class="menu-title">Forms</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
              <li class="nav-item"><a href="{{ url('/forms/basic-elements') }}" class="nav-link {{ active_class(['forms/basic-elements']) }}">Basic Elements</a></li>
              <li class="nav-item"><a href="{{ url('/forms/advanced-elements') }}" class="nav-link {{ active_class(['forms/advanced-elements']) }}">Advanced Elements</a></li>
              <li class="nav-item"><a href="{{ url('/forms/editors') }}" class="nav-link {{ active_class(['forms/editors']) }}">Editors</a></li>
              <li class="nav-item"><a href="{{ url('/forms/wizard') }}" class="nav-link {{ active_class(['forms/wizard']) }}">Wizard</a></li>
            </ul>
          </div>
        </li> -->
        <!-- <li class="nav-item {{ active_class(['charts/*', 'tables/*']) }}">
          <a href="#" class="nav-link">
            <i class="link-icon" data-feather="pie-chart"></i>
            <span class="menu-title">Data</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <div class="row">
              <div class="col-md-6">
                <ul class="submenu-item pr-0">
                  <li class="category-heading">Charts</li>
                  <li class="nav-item"><a href="{{ url('/charts/apex') }}" class="nav-link {{ active_class(['charts/apex']) }}">Apex</a></li>
                  <li class="nav-item"><a href="{{ url('/charts/chartjs') }}" class="nav-link {{ active_class(['charts/chartjs']) }}">ChartJs</a></li>
                  <li class="nav-item"><a href="{{ url('/charts/flot') }}" class="nav-link {{ active_class(['charts/flot']) }}">Float</a></li>
                  <li class="nav-item"><a href="{{ url('/charts/morrisjs') }}" class="nav-link {{ active_class(['charts/morrisjs']) }}">Morris</a></li>
                  <li class="nav-item"><a href="{{ url('/charts/peity') }}" class="nav-link {{ active_class(['charts/peity']) }}">Peity</a></li>
                  <li class="nav-item"><a href="{{ url('/charts/sparkline') }}" class="nav-link {{ active_class(['charts/sparkline']) }}">Sparkline</a></li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="submenu-item pl-0">
                  <li class="category-heading">Tables</li>
                  <li class="nav-item"><a href="{{ url('/tables/basic-tables') }}" class="nav-link {{ active_class(['tables/basic-tables']) }}">Basic Tables</a></li>
                  <li class="nav-item"><a href="{{ url('/tables/data-table') }}" class="nav-link {{ active_class(['tables/data-table']) }}">Data Table</a></li>
                </ul>
              </div>
            </div>
          </div>
        </li> -->
        <!-- <li class="nav-item {{ active_class(['icons/*']) }}">
          <a href="#" class="nav-link">
            <i class="link-icon" data-feather="smile"></i>
            <span class="menu-title">Icons</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
              <li class="nav-item"><a href="{{ url('/icons/feather-icons') }}" class="nav-link {{ active_class(['icons/feather-icons']) }}">Feather Icons</a></li>
              <li class="nav-item"><a href="{{ url('/icons/flag-icons') }}" class="nav-link {{ active_class(['icons/flag-icons']) }}">Flag Icons</a></li>
              <li class="nav-item"><a href="{{ url('/icons/mdi-icons') }}" class="nav-link {{ active_class(['icons/mdi-icons']) }}">Mdi Icons</a></li>
            </ul>
          </div>
        </li> -->
        <!-- <li class="nav-item mega-menu {{ active_class(['general/*', 'error/*', 'auth/*']) }}">
          <a href="#" class="nav-link">
            <i class="link-icon" data-feather="book"></i>
            <span class="menu-title">Sample Pages</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <div class="col-group-wrapper row">
              <div class="col-group col-md-6">
                <p class="category-heading">Special Pages</p>
                <div class="submenu-item">
                  <div class="row">
                    <div class="col-md-6">
                      <ul>
                        <li class="nav-item"><a href="{{ url('/general/blank-page') }}" class="nav-link {{ active_class(['general/blank-page']) }}">Blank page</a></li>
                        <li class="nav-item"><a href="{{ url('/general/faq') }}" class="nav-link {{ active_class(['general/faq']) }}">Faq</a></li>
                        <li class="nav-item"><a href="{{ url('/general/invoice') }}" class="nav-link {{ active_class(['general/invoice']) }}">Invoice</a></li>
                      </ul>
                    </div>
                    <div class="col-md-6">
                      <ul>
                        <li class="nav-item"><a href="{{ url('/general/profile') }}" class="nav-link {{ active_class(['general/profile']) }}">Profile</a></li>
                        <li class="nav-item"><a href="{{ url('/general/pricing') }}" class="nav-link {{ active_class(['general/pricing']) }}">Pricing</a></li>
                        <li class="nav-item"><a href="{{ url('/general/timeline') }}" class="nav-link {{ active_class(['general/timeline']) }}">Timeline</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-group col-md-3">
                <p class="category-heading">Auth Pages</p>
                <ul class="submenu-item">
                  <li class="nav-item"><a href="{{ url('/auth/login') }}" class="nav-link {{ active_class(['auth/login']) }}">Login</a></li>
                  <li class="nav-item"><a href="{{ url('/auth/register') }}" class="nav-link {{ active_class(['auth/register']) }}">Register</a></li>
                </ul>
              </div>
              <div class="col-group col-md-3">
                <p class="category-heading">Error Pages</p>
                <ul class="submenu-item">
                  <li class="nav-item"><a href="{{ url('/error/404') }}" class="nav-link {{ active_class(['error/404']) }}">404</a></li>
                  <li class="nav-item"><a href="{{ url('/error/500') }}" class="nav-link {{ active_class(['error/500']) }}">500</a></li>
                </ul>
              </div>
            </div>
          </div>
        </li> -->
        <!-- <li class="nav-item">
          <a href="https://www.nobleui.com/laravel/documentation/docs.html" target="_blank" class="nav-link">
            <i class="link-icon" data-feather="hash"></i>
            <span class="menu-title">Documentation</span></a>
        </li> -->
      </ul>
    </div>
  </nav>
</div>
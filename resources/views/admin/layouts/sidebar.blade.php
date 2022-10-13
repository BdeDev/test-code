<div id="sidebar" class="navbar-nav-left sidebar">
  <nav class="navbar navbar-expand-xl">
    <a class="navbar-brand" href="{{ url('/') }}"><b>Laravel Base</b></a>
    <div class="collapse navbar-collapse" id="sidebar-nav">
      <ul id="accordion" class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/dashboard') }}"><i class="far fa-tachometer-alt-fastest"></i> <span>Dashboard</span></a>
        </li>
        @if (Auth::user() && Auth::user()->role == App\Models\User::ROLE_ADMIN)
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#manage" role="button" aria-expanded="false" aria-controls="manage">
            <i class="fas fa-list-alt"></i> <span>Manage</span>
          </a>
          <div class="collapse" id="manage" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard/logs') }}"><i class="fas fa-list"></i> <span> Logger</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard/backup') }}"><i class="fas fa-list"></i> <span> Backup</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ url('/files') }}"><i class="fas fa-list"></i> <span> Files</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard/users') }}"><i class="fas fa-list"></i> <span> Users</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/settings/') }}"><i class="fas fa-list"></i> <span> Settings</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ url('/notifications') }}"><i class="fas fa-list"></i> <span> Notifications</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/comment') }}"><i class="fas fa-comment"></i> <span> Comment</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/logActivity') }}"><i class="fas fa-list"></i> <span> User History</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/sms') }}"><i class="fas fa-list"></i> <span> Sms</span></a>
              </li>
            </ul>
          </div>

        </li>
        <li class="nav-item menu-list" data-id="page_management">
          <a class="nav-link" data-toggle="collapse" href="#page" role="button" aria-expanded="false" aria-controls="page">
            <i class="fas fa-fire"></i> <span>Page Management</span>
          </a>
          <div class="collapse" id="page" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('page')}}"><i class="fas fa-fire"></i> <span>Pages</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('faq')}}"><i class="fas fa-fire"></i> <span>Faqs</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('favourite')}}"><i class="fas fa-fire"></i> <span>Favourites</span></a>
              </li>

            </ul>
          </div>
        </li>

        
        
        
        
        <li class="nav-item menu-list" data-id="seo">
          <a class="nav-link" data-toggle="collapse" href="#seo" role="button" aria-expanded="false" aria-controls="seo">
            <i class="fas fa-key"></i> <span>Seo</span>
          </a>
          <div class="collapse" id="seo" data-parent="#accordion">
            <ul class="sub-navbar-nav">
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('seo/')}}"><i class="fas fa-fire"></i> <span>Home</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('seo/manager')}}"><i class="fas fa-fire"></i> <span>Meta</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('seo/analytics')}}"><i class="fas fa-fire"></i> <span>Analytics</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('seo/redirect')}}"><i class="fas fa-fire"></i> <span>Redirect</span></a>
              </li>
              
             
            </ul>
          </div>
        </li>
      
        <li class="nav-item">
                <a class="nav-link" href="{{ url('/serviceProvider') }}"><i class="fa fa-users"></i> <span>Service Providers</span></a>
        </li>

        <li class="nav-item menu-list" data-id="services">
          <a class="nav-link" data-toggle="collapse" href="#services" role="button" aria-expanded="false" aria-controls="services">
            <i class="fa fa-wrench"></i> <span>Services</span>
          </a>

          <div class="collapse" id="services" data-parent="#accordion">
            <ul class="sub-navbar-nav">
            <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('/services/booking-req')}}"><i class="fas fa-bars"></i> <span>Booking Request</span></a>
              </li>
            <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('/services')}}"><i class="fa fa-bars"></i> <span>Service Management</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('services/category')}}"><i class="fa fa-bars"></i> <span>Category</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('services/sub-category')}}"><i class="fas fa-bars"></i> <span>Sub-Category</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link menu-list-link" href="{{ url('services/add-on')}}"><i class="fas fa-bars"></i> <span>Add-on Services</span></a>
              </li>
             
             
            </ul>
          </div>
          <div  id="chat">
          <li class="nav-item">
              <a class="nav-link" href="{{ url('/chat') }}"><i class="fas fa-comments"></i> <span>Chats</span></a>
          </li>
        </div>
        @endif
        <div  id="book">
        <li class="nav-item">
              <a class="nav-link" href="{{ url('/booking') }}"><i class="fa fa-window-maximize"></i> <span>Booking</span></a>
        </li>
        </div>
        <div  id="chat">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/chat') }}"><i class="fas fa-comments"></i> <span>Chats</span></a>
        </li>
        </div>

      </ul>
    </div>
    </li>
    </ul>
</div>
</nav>
</div>
<nav class="navbar navbar-inverse">
          <div class="container-flex">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{URL::asset('website-logo.png')}}" width="150" class="website_logo"/>
              </a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li><a href="{{url('/department')}}">Departments</a></li>
                <li><a href="{{url('/employee')}}">Employees</a></li>
                <li><a href="{{url('/posts')}}">News & Articles</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span style="width: 50px;">{{ Auth::user()->username }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-header">Manage Articles</li>
                          <li><a href="{{url('/posts/add')}}"><i class="fa fa-plus"></i> Add Article</a></li>
                          <li><a href="{{url('/posts/categories')}}"><i class="fa fa-list"></i> Catergories</a></li>
                          <li class="divider" role="separator"></li>
                          <li class="dropdown-header">Manage Departments & Employee</li>
                          <li><a href="{{url('/department/add')}}"><i class="fa fa-plus"></i> Add Department</a></li>
                          <li><a href="{{url('/employee/add')}}"><i class="fa fa-plus"></i> Add Employee</a></li>
                          <li class="divider" role="separator"></li>
                          <li class="dropdown-header">Admin Profile Settings</li>
                          <li><a href="{{url('/update/password')}}"><i class="fa fa-edit"></i> Edit Password</a></li>
                          <li><a href="{{url('/invite')}}"><i class="fa fa-edit"></i> Invite admin</a></li>
                          <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>

                        </ul>
                    </li>
                @endif
              </ul>
            </div><!--/.nav-collapse -->
          </div>
    </nav>
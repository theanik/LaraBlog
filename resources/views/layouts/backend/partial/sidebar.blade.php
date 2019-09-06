<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
        @if (!Auth::user()->image == "default.png")
        <img src="{{url('storage/profileImg/'.Auth::user()->image)}}" width="48" height="48" alt="User" />
        @else
        <img src="/img/default.png" width="48" height="48" alt="User" />
        @endif
        
        </div>
        <div class="info-container">
        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
        <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right" style="margin-left:-100px">
                    <li><a href="{{ Auth::user()->role_id == 1 ? route('admin.settings') : route('author.settings') }}"><i class="material-icons">person</i>Profile</a></li>
                   
                    <li> 
                        {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                        </a> --}}

                        {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            {{-- admin route --}}
            @if(Request::is('admin*'))
                <li class="{{Request::is('admin/dashboard') ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/tag*') ? 'active' : ''}}">
                    <a href="{{route('admin.tag.index')}}">
                        <i class="material-icons">loyalty</i>
                        <span>Tag</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/category*') ? 'active' : ''}}">
                    <a href="{{route('admin.category.index')}}">
                        <i class="material-icons">category</i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/post*') ? 'active' : ''}}">
                    <a href="{{route('admin.post.index')}}">
                        <i class="material-icons">local_post_office</i>
                        <span>Posts</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/pending/post') ? 'active' : ''}}">
                    <a href="{{route('admin.post.pending')}}">
                        <i class="material-icons">restore</i>
                        <span>Pending Posts</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/subscriber') ? 'active' : ''}}">
                    <a href="{{route('admin.subscriber.index')}}">
                        <i class="material-icons">whatshot</i>
                        <span>Subscriber</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/authors') ? 'active' : ''}}">
                    <a href="{{route('admin.authors.index')}}">
                        <i class="material-icons">supervised_user_circle</i>
                        <span>Authors</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/alladmin') ? 'active' : ''}}">
                    <a href="{{route('admin.admins.index')}}">
                        <i class="material-icons">supervised_user_circle</i>
                        <span>All Admin</span>
                    </a>
                </li>
                <li class="header">SETTING</li>
                <li class="{{Request::is('admin/settings') ? 'active' : ''}}">
                    <a href="{{route('admin.settings')}}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            <span>Log Out</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>
            @endif

            {{-- autor route --}}
            @if(Request::is('author*'))
                <li class="{{Request::is('author/dashboard') ? 'active': ''}}">
                    <a href="{{route('author.dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="{{Request::is('author/post*') ? 'active' : ''}}">
                    <a href="{{route('author.post.index')}}">
                        <i class="material-icons">local_post_office</i>
                        <span>Posts</span>
                    </a>
                </li>
                <li class="header">SETTING</li>
                <li class="{{Request::is('author/settings') ? 'active' : ''}}">
                    <a href="{{route('author.settings')}}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            <span>Log Out</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>
            @endif
                
            

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2019 <a href="javascript:void(0);">Anik Anwar</a>.
        </div>
    </div>
    <!-- #Footer -->
</aside>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ asset('backend/assets/images/users/profile.png')}}" alt="user" />
                <!-- this is blinking heartbit-->
                <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
            </div>
            <!-- User profile text-->
            <div class="profile-text">
                <h5>{{ Auth::user()->name }}</h5>
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                <a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                @auth('admin')
                <a href="{{route('admin.logout')}}" class="" data-toggle="tooltip" title="Logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="mdi mdi-power"></i>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endauth
                <div class="dropdown-menu animated flipInY">
                    <!-- text-->
                    <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <!-- text-->
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                    <!-- text-->
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <!-- text-->
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                    <!-- text-->
                    <div class="dropdown-divider"></div>
                    <!-- text-->
                    <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                    <!-- text-->
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            @if(Auth::user()->type==1)
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-small-cap">PERSONAL</li>

                <!--new user-->

                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('dashboard.newuser')}}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu"> New User</span></a>

                </li>

                <!--dashboard -->
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>

                </li>
                <!--category -->

                @if(Auth::user()->type==1)
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.categories.index') }}" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Category</span></a>

                </li>
                @endif

                <!--subcategory -->
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.subcategories.index') }}" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">SubCategory</span></a>

                </li>


                <!--product -->
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.products.index') }}" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Product</span></a>

                </li>

                <!--brand -->
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.brands.index') }}" aria-expanded="false"><i class="mdi mdi-widgets"></i><span class="hide-menu">Brand</span></a></li>

                <!--color -->
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.colors.index') }}" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Color</span></a>

                </li>

                <!--size -->
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.sizes.index') }}" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Size</span></a>

                </li>

                <!--wrapping -->

                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.wrapps.index') }}" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Wrapping</span></a>

                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.countries.index') }}" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Country</span></a>

                </li>


                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.cities.index') }}" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">City</span></a>

                </li>

                @if(Auth::user()->type==2||Auth::user()->type==1)
                <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.payments.index') }}" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Payment</span></a>

                </li>
                @endif

                
                @if(Auth::user()->type==2||Auth::user()->type==1)
                <li>
                 <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.sales.index') }}" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Sale</span></a>

                </li>
                @endif


                @if(Auth::user()->type==2|| Auth::user()->type==1)
                  <li> <a class="has-arrow waves-effect waves-dark" href="{{ route('admin.offers.index') }}" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Offer</span></a>

                </li>
                @endif

            </ul>
            @endif
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

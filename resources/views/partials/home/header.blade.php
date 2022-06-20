<div class="container">
    <div class="header_section_top">
        <div class="row">
            <div class="col-sm-12">
                <div class="custom_menu">
                    <ul style="float: left;margin-left:20px">
                        <li><a href="#">R4@example.com</a></li>
                        <li><a href="#">+1 1800 1200 1200</a></li>
                    </ul>
                    {{-- <ul style="float: right;margin-right:20px">
                        <li><a href="#">user</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="logo_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="banner_taital">R4</h1>
            </div>
        </div>
    </div>
</div>

<div class="header_section">
    <div class="container">
        <div class="containt_main">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="{{ route('home.user') }}">Home</a>
                <a href="fashion.html">Bill</a>
                <a href="electronic.html">Contact</a>
                <a href="jewellery.html">Jewellery</a>
            </div>
            <span class="toggle_icon" onclick="openNav()"><img
                    src="{{ asset('Home/images/toggle-icon.png') }}"></span>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value="">Car
                    Type
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('home.user') }}">All Type</a>
                    @foreach ($car_types as $item)
                        <a class="dropdown-item"
                            href="{{ route('search-by-type', ['slug' => $item->label, 'id' => $item->id]) }}">{{ $item->label }}</a>
                    @endforeach
                </div>
            </div>
            <div class="main">

                <form action="">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ $search }}" class="form-control"
                            placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"
                                style="background-color: #f26522; border-color:#f26522 ">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="header_box">
                <div class="login_menu">
                    <ul>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::check())
                                    {{ Auth::user()->username }}
                                @endif
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#showUserModal"
                                    href="#"> User Profile</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePassword"
                                    href="#">Change Password</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#update"
                                    href="#">Update Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </div>
                        </div>

                        <li><a href=" {{ route('cart.list') }}">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span class="padding_10">Cart</span></a>
                        </li>
                        <li><a href="{{ route('booked.car') }}">
                        {{-- <li><a href="" data-bs-toggle="modal" data-bs-target="#received"> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-card-checklist" viewBox="0 0 16 16">
                                    <path
                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                    <path
                                        d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                </svg>
                                <span class="padding_10">Booked</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal change password --}}
<div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="changePassword" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePassword">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('change-password', 'test') }}" method="post">
                @method('post')
                @csrf
                <div class="modal-body">
                    @include('common.profile-user.modal-change-password')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal update --}}
<div class="modal fade" id="update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="update" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update">Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-auth', 'test') }}" method="post">
                @method('post')
                @csrf
                <div class="modal-body">
                    @include('common.profile-user.modal-update-auth')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- show user --}}
<div class="modal fade" id="showUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showUserModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showUserModal">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get">
                @csrf
                <div class="modal-body">
                    @include('common.profile-user.modal-show-user')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Recevied</button>
                </div>
            </form>
        </div>
    </div>
</div>




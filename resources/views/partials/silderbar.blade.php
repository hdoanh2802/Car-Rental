<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CAR RENTAL R4</span>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class=" mt-3 pb-3 mb-3 d-flex" style="margin-left:20px">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }} " width="40px" height="40px"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info" style="margin-left:10px">
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
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt fa-2x"  style="margin-right: 25px"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
                <li class="nav-item">
                    <a href="{{ route('user.list') }}" class="nav-link">
                        <i class="fas fa-solid fa-users fa-2x text-gray-300" style="margin-right: 20px"> </i>
                        <p>
                            Account
                        </p>
                    </a>
                </li>

                <li class="nav-item" style="width: 0ch">
                    <a href="{{ route('car-type.list') }}" class="nav-link">
                        <i class="nav-icon fas fa-th fa-2x" style="margin-right: 30px"> </i>
                        <p>
                            Car type
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('car.list') }}" class="nav-link">
                        <i class="fas fa-solid fa-car fa-2x text-gray-300" style="margin-right: 25px"> </i>
                        <p>
                            Car
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('booking.list') }}" class="nav-link">
                        <i class="fas fa-solid fa-box fa-2x text-gray-300" style="margin-right: 25px"> </i>
                        <p>
                            Booking
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('office.list') }}" class="nav-link">
                        <i class="fas fa-solid fa-building fa-2x text-gray-300" style="margin-right: 30px"> </i>
                        <p>
                            Office
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

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
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal changed password --}}
<div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="changePassword" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePassword">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('change-password', 'password') }}" method="post">
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

{{-- modal update profile --}}
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



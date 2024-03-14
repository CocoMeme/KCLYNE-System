
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KCLYNE</title>

    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="{{ asset('css/header-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/register-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/message.css') }}" rel="stylesheet">

</head>

<header>
    {{-- FOR ADMIN --}}
    {{-- @auth('admin')

        <div class="sidebar">

            <div class="logo">
                <img src="layouts/SPark-logo.png" alt="Logo">
            </div>

            <div class="menu-items">
                <ul>
                    <li><a href="/"><i class='bx bx-home'></i> <span>Home</span></a></li>
                    <li><a href="/slots-control-admin"><i class='bx bx-calendar'></i> <span>Slot Control</span></a></li>
                    <li><a href="/user-management"><i class='bx bx-user'></i> <span>User Management</span></a></li>
                    <li><a href="/paymentManagement"><i class='bx bx-wallet'></i> <span>Payment Management</span></a></li>
                    <li><a href="/history-admin"><i class='bx bx-book'></i> <span>Rental Record</span></a></li>
                    <li><a href="/summary"><i class='bx bx-bar-chart'></i> <span>Summary Report</span></a></li>
                </ul>
            </div>

            <div class="logout-button">
                <form action="/logout-admin" method="POST">
                    @csrf
                    <button type="submit"><i class='bx bx-log-out-circle'></i></button>
                </form>
            </div>

        </div>
     --}}
        

    {{-- FOR CUSTOMER --}}
    {{-- @else --}}
        @auth
            <a href="/" class="logo"><img src="/Images/Layouts/KCLYNE-Logo.png" alt=""></a>
            <ul class="navmenu">
                <li><a href="/">Home</a></li>|
                <li><a href="/">Shop</a></li>|
                <li><a href="/">Payment Form</a></li>|
                <li><a href="/">About Us</a></li>
            </ul>

            <div class="nav-icon">
                <a href="/notifications">
                    <i class='bx bx-bell'></i>
                </a>
                <form action="/userprofile" method="GET">
                    @csrf
                    <button class="userporfile" type="submit">
                        <i class='bx bxs-user-circle'></i>
                    </button>
                </form>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="logout-button" type="submit">
                        <i class='bx bx-log-out-circle'></i>
                    </button>
                </form>
            </div>

        {{-- FOR VISITORS --}}
        @else
            <a href="/" class="logo"><img src="/Images/Layouts/KCLYNE-Logo.png" alt=""></a>
            <ul class="navmenu">
                <li><a href="/">Home</a></li>
                <li><a href="/">Shop</a></li>
                <li><a href="/">About Us</a></li>
            </ul>

            <div class="search">
                <input type="text" placeholder="Search a Product">
                <a href="" ><i class='bx bx-search-alt'></i></a>
            </div>

            <div class="nav-icon">
                <a href="register"><i class='bx bx-user-plus'></i></a>
                <a href="login"><i class='bx bx-log-in-circle'></i></a>
            </div>
        @endauth
    {{-- @endauth --}}
</header>


@extends('Layouts/header')

<body>

    <section class="section-admin-login">
        <div class="admin-login">
            <form class="form-admin-login" action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <h2>ADMIN LOGIN PAGE</h2>

                @if ($errors->any())
                    <div class="admin-login-error">
                        <p>{{ $errors->first('error') }}</p>
                    </div>
                @endif

                <input name="username" type="text" placeholder="Enter your Username">
                @error('username') <span class="admin-login-error">{{ $message }}</span>@enderror
                <input name="password" type="password" placeholder="Enter your Password">
                @error('password') <span class="admin-login-error">{{ $message }}</span>@enderror
                <button>Login</button>
                <p>Administration Staffs Only</p>
            </form>
        </div>
    </section>

</body>
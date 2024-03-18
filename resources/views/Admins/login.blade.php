@extends('Layouts/header')

<body>

    <section class="user-login-page">
        <div class="login-page">
            <form class="form-login-page" action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <h2>ADMIN LOGIN PAGE</h2>

                @if ($errors->any())
                    <div class="error-message">
                        <p>{{ $errors->first('error') }}</p>
                    </div>
                @endif

                <input name="username" type="text" placeholder="Enter your Username">
                @error('username') <span class="error">{{ $message }}</span>@enderror
                <input name="password" type="password" placeholder="Enter your Password">
                @error('password') <span class="error">{{ $message }}</span>@enderror
                <button>Login</button>
                <p>Administration Staffs Only</p>
            </form>
        </div>
    </section>

    {{-- <section class="section-register-admin">
        <dev class="container">
            
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
            
                <div>
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" required autofocus>
                </div>
            
                <div>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>
            
                <div>
                    <button type="submit">Login</button>
                </div>
            </form>

        </dev>
    </section> --}}

</body>
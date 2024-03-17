@extends('Layouts/header')

<body>

    <section class="section-register-admin">
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
    </section>

</body>
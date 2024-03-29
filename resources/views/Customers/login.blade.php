@extends('Layouts.header')

<body>

    <section class="section-customer-login">
        <div class="customer-login">
            <form class="form-customer-login" action="{{ route('customer.login.submit') }}" method="POST">
                @csrf
                <h2>CUSTOMER LOGIN PAGE</h2>

                @if ($errors->any())
                    <div class="customer-login-error">
                        <p>{{ $errors->first('error') }}</p>
                    </div>
                @endif

                <input name="email" type="email" placeholder="Enter your Email">
                @error('email') <span class="customer-login-error">{{ $message }}</span>@enderror
                <input name="password" type="password" placeholder="Enter your Password">
                @error('password') <span class="customer-login-error">{{ $message }}</span>@enderror
                <button>Login</button>
                <p>For Customers Only</p>
            </form>
        </div>
    </section>

</body>

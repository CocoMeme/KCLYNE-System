@extends('Layouts/header')

<body>

    <section class="user-register-page">
        <div class="register-page">
            <form class="form-register-page" action="{{ route('admin.register') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <h2 style="text-align: center;">ADMIN REGISTER PAGE</h2>
    
              <input name="username" type="text" placeholder="Create a Username" value="{{ old('username') }}">
              @error('username') <span class="error">{{ $message }}</span>@enderror
    
              <input name="password" type="password" placeholder="Create a Password" value="{{ old('password') }}">
              @error('password')<span class="error">{{ $message }}</span>@enderror
    
              <input name="password_confirmation" type="password" placeholder="Confirm Password">
    
              <button>Register</button>
              <p>Authorized Personnel Only</p>
            </form>
        </div>
    

    {{-- <section class="section-register-admin">
    
        <div class="container">

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.register') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>

                                    <div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </section>

</body>
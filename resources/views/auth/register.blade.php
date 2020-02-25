@extends('layouts.app')

@section('content')
<div class="container">
    <section class="hero">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Register</h3>
                    <hr class="login-hr">
                    <div class="box">
                        <figure class="avatar">
                            <img src="{{asset('images/logo/mylogo.png')}}">
                        </figure>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="field">
                                <div class="control">
                                    <input name="name" class="input is-small {{$errors->has('name') ? "is-danger" : ""}}" type="text" placeholder="Name" value="{{old('name')}}" autofocus="" required>
                                    @if ($errors->has('name'))
                                        <span class="help is-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="email" class="input is-small {{$errors->has('email') ? "is-danger" : ""}}" type="email" placeholder="Email" value="{{old('email')}}" autofocus="" required>
                                    @if ($errors->has('email'))
                                        <span class="help is-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="password" class="input is-small {{$errors->has('password') ? "is-danger" : ""}}" type="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="help is-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="password_confirmation" class="input is-small {{$errors->has('password_confirmation') ? "is-danger" : ""}}" type="password" placeholder="Confirm Password" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help is-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-info is-small is-fullwidth"><i class="fa fa-sign-in" aria-hidden="true">Register</i></button>
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="../">Login</a> &nbsp;·&nbsp;
                        <a href="../">Need Help?</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
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
    </div> --}}
</div>
@endsection

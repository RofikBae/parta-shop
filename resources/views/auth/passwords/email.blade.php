@extends('layouts.app')

@section('content')
<div class="container">
    <section class="hero">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Reset Password</h3>
                    <hr class="login-hr">
                    <div class="box">
                        <figure class="avatar">
                            <img src="{{asset('images/logo/mylogo.png')}}">
                        </figure>
                        <form action="{{route('password.email')}}" method="POST">
                            @csrf
                            <div class="field">
                                <div class="control">
                                    <input name="email" class="input is-small {{$errors->has('email') ? "is-danger" : ""}}" type="email" placeholder="Your Email" autofocus="" required>
                                    @if ($errors->has('email'))
                                        <span class="help is-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-info is-small is-fullwidth">
                                <i class="fa fa-sign-in" aria-hidden="true">
                                    Send Email Reset Password
                                </i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

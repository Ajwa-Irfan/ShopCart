@extends('layouts.app')

@section('title', 'Login - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; display:flex; align-items:center; padding:60px 0;">
        <div class="container">
            <div class="auth-wrapper">

                <div class="auth-left">
                    <div class="auth-brand">
                        <span style="color:#fff; font-weight:900; font-size:1.8rem;">Shop</span><span style="color:#e73958; font-weight:900; font-size:1.8rem;">Cart</span>
                    </div>
                    <h2 class="auth-heading">Welcome<br>Back! 👋</h2>
                    <p class="auth-sub">Login and continue your shopping journey.</p>
                    <div class="auth-features">
                        <div class="auth-feat"><span>🚚</span> Free delivery above Rs. 2000</div>
                        <div class="auth-feat"><span>🔒</span> 100% secure payments</div>
                        <div class="auth-feat"><span>↩️</span> Easy 7-day returns</div>
                    </div>
                </div>

                <div class="auth-right">
                    <h4 class="form-heading">Login to your account</h4>
                    <p class="form-sub">Enter your credentials below</p>

                    @if($errors->any())
                        <div class="auth-error">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label-custom">Email Address</label>
                            <div class="input-wrap">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="auth-input" placeholder="your@email.com" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Password</label>
                            <div class="input-wrap">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" name="password"
                                       class="auth-input" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="remember-row">
                            <label class="remember-label">
                                <input type="checkbox" name="remember">
                                <span>Remember me</span>
                            </label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                            @endif
                        </div>
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                        <p class="switch-auth">
                            Don't have an account?
                            <a href="{{ route('register') }}">Register here</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>

    @include('auth.auth-styles')
@endsection

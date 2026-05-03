@extends('layouts.app')

@section('title', 'Register - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; display:flex; align-items:center; padding:60px 0;">
        <div class="container">
            <div class="auth-wrapper">

                <div class="auth-left">
                    <div class="auth-brand">
                        <span style="color:#fff; font-weight:900; font-size:1.8rem;">Shop</span><span style="color:#e73958; font-weight:900; font-size:1.8rem;">Cart</span>
                    </div>
                    <h2 class="auth-heading">Join<br>ShopCart! 🛍️</h2>
                    <p class="auth-sub">Create account and enjoy exclusive deals.</p>
                    <div class="auth-features">
                        <div class="auth-feat"><span>🎁</span> First order 30% OFF</div>
                        <div class="auth-feat"><span>📦</span> Track your orders</div>
                        <div class="auth-feat"><span>⭐</span> Exclusive member deals</div>
                    </div>
                </div>

                <div class="auth-right">
                    <h4 class="form-heading">Create new account</h4>
                    <p class="form-sub">Register for free</p>

                    @if($errors->any())
                        <div class="auth-error">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label-custom">Full Name</label>
                            <div class="input-wrap">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="auth-input" placeholder="Your full name" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Email Address</label>
                            <div class="input-wrap">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="auth-input" placeholder="your@email.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Password</label>
                            <div class="input-wrap">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" name="password"
                                       class="auth-input" placeholder="Min 8 characters" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Confirm Password</label>
                            <div class="input-wrap">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" name="password_confirmation"
                                       class="auth-input" placeholder="Confirm your password" required>
                            </div>
                        </div>
                        <button type="submit" class="auth-btn">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </button>
                        <p class="switch-auth">
                            Already have an account?
                            <a href="{{ route('login') }}">Login here</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>

    @include('auth.auth-styles')
@endsection
